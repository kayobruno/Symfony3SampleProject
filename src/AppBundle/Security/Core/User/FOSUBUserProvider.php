<?php

namespace AppBundle\Security\Core\User;

use AppBundle\Entity\User;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseFOSUBProvider;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Security\Core\User\UserInterface;

class FOSUBUserProvider extends BaseFOSUBProvider
{
    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();
        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();
        $setter = 'set'.ucfirst($service);
        $setterId = $setter.'Id';
        $setterToken = $setter.'AccessToken';
        //we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy(array($property => $username))) {
            $previousUser->$setterId(null);
            $previousUser->$setterToken(null);
            $this->userManager->updateUser($previousUser);
        }
        //we connect current user
        $user->$setterId($username);
        $user->$setterToken($response->getAccessToken());
        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();
        $email = $response->getEmail();
        $user = $this->userManager->findUserBy(['email'=>$email]);
        if (null === $user) {
            throw new UnauthorizedHttpException('OAuth realm="Registered users only"');
        }
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set'.ucfirst($serviceName);
        $setterId = $setter.'Id';
        $setterToken = $setter.'AccessToken';

        /** @var User $user */
        $user->$setterId($username);
        $user->$setterToken($response->getAccessToken());
        $user->setName(str_replace('Sobrancelhas Design', 'SD', $response->getRealName()));
        $user->setPassword(time());
        $this->userManager->updateUser($user);

        return $user;
    }
}
