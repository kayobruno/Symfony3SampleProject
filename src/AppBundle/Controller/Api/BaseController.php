<?php

namespace AppBundle\Controller\Api;

use AppBundle\Api\ApiProblem;
use AppBundle\Api\ApiProblemException;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

class BaseController extends Controller
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Serializa um dado no formato desejado
     *
     * @param mixed  $data   Dado a ser serializado
     * @param string $format Formato desejado
     * @return mixed Dado serializado no formato desejado
     */
    protected function serialize($data, $format = 'json')
    {
        $context = new SerializationContext();
        $context->setSerializeNull(true);

        $request = $this->get('request_stack')->getCurrentRequest();
        $groups = ['Default'];
        if ($request->query->getBoolean('deep')) {
            $groups[] = 'deep';
        }
        $context->setGroups($groups);

        return $this->get('jms_serializer')->serialize($data, $format, $context);
    }

    /**
     * Cria uma resposta padronizada para a API
     *
     * @param mixed $data       Dados a serem serializados e retornados
     * @param int   $statusCode HTTP status code
     * @return Response
     */
    protected function createApiResponse($data, $statusCode = 200)
    {
        $json = $this->serialize($data);
        return new Response($json, $statusCode, [
            'Content-Type' => 'application/json'
        ]);
    }

    /**
     * Retorna o corpo de uma requisição em formato array
     *
     * @param Request $request
     * @return mixed
     */
    protected function getParsedBody(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return $data;
    }

    /**
     * Obtem o valor de um parâmetro a partir do corpo de uma requisição
     *
     * @param Request $request
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    public function getParsedBodyParam(Request $request, $key, $default = null)
    {
        $params = $this->getParsedBody($request);
        if (is_array($params) && isset($params[$key])) {
            return $params[$key];
        }
        return $default;
    }

    /**
     * Processa os dados recebidos e submete um formulário
     *
     * @param Request $request
     * @param FormInterface $form
     * @throws ApiProblemException se o JSON recebido na requisição não for válido
     */
    protected function processForm(Request $request, FormInterface $form)
    {
        if ($request->getMethod() == 'GET') {
            $data = $request->query->all();
        } else {
            $data = $this->getParsedBody($request);
            if ($data === null) {
                $apiProblem = new ApiProblem(422, ApiProblem::TYPE_INVALID_REQUEST_BODY_FORMAT);
                throw new ApiProblemException($apiProblem);
            }
        }
        $clearMissing = $request->getMethod() != 'PATCH';
        $form->submit($data, $clearMissing);
    }

    /**
     * Reúne os erros encontrados em um formulário
     *
     * @param FormInterface $form Formulário inválido a ter os erros reunidos
     * @return array erros encontrados no formulário
     */
    protected function getErrorsFromForm(FormInterface $form)
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }

    /**
     * Valida um formulário e lança uma exceção que interrompe a requisição, caso não seja válido
     *
     * @param FormInterface $form
     * @param Request $request
     */
    protected function validateForm(FormInterface $form, Request $request)
    {
        $this->processForm($request, $form);
        if (!$form->isValid()) {
            $this->throwApiProblemValidationException($form);
        }
    }

    /**
     * Prepara e executa o lançamento de uma exceção genérica
     *
     * @param array $errors     Erros encontrados
     * @param int   $statusCode Código de status HTTP
     */
    protected function throwApiProblemException(array $errors, $statusCode)
    {
        $apiProblem = new ApiProblem($statusCode);
        $apiProblem->set('errors', $errors);
        throw new ApiProblemException($apiProblem);
    }

    /**
     * Prepara e executa o lançamento de uma exceção apropriada para
     * um problema de validação encontrado em um formulário
     *
     * @param FormInterface $form Formulário inválido
     * @throws ApiProblemException
     */
    protected function throwApiProblemValidationException(FormInterface $form)
    {
        $errors = $this->getErrorsFromForm($form);
        $apiProblem = new ApiProblem(Response::HTTP_UNPROCESSABLE_ENTITY, ApiProblem::TYPE_VALIDATION_ERROR);
        $apiProblem->set('errors', $errors);
        throw new ApiProblemException($apiProblem);
    }
}
