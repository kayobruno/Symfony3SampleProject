import { toggle } from './utils'

const menuButton = document.getElementById('header-menu-toggle-button')
if (menuButton) {
  menuButton.addEventListener('click', () => toggle('menu'))
}
