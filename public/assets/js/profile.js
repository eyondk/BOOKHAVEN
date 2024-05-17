(() => {

    'use-strict'
  
    const themeSwiter = {
  
      init: function() {
        this.wrapper = document.getElementById('theme-switcher-wrapper')
        this.button = document.getElementById('theme-switcher-button')
        this.theme = this.wrapper.querySelectorAll('[data-theme]')
        this.themes = ['theme-orange', 'theme-purple', 'theme-green', 'theme-blue']
        this.events()
        this.start()
      },
      
      events: function() {
        this.button.addEventListener('click', this.displayed.bind(this), false)
        this.theme.forEach(theme => theme.addEventListener('click', this.themed.bind(this), false))
      },
  
      start: function() {
        let theme = this.themes[Math.floor(Math.random() * this.themes.length)]
        document.body.classList.add(theme)
      },
  
      displayed: function() {
        (this.wrapper.classList.contains('is-open'))
          ? this.wrapper.classList.remove('is-open')
          : this.wrapper.classList.add('is-open')
      },
  
      themed: function(e) {
        this.themes.forEach(theme => {
          if(document.body.classList.contains(theme))
            document.body.classList.remove(theme)
        })
        return document.body.classList.add(`theme-${e.currentTarget.dataset.theme}`)
      }
  
    }
  
    themeSwiter.init()
  
  })()

  function showProfile() {
    document.getElementById('profile').style.display = 'block';
    document.getElementById('editAccount').style.display = 'none';
    document.getElementById('changePassword').style.display = 'none';
}

function showEditAccount() {
    document.getElementById('profile').style.display = 'none';
    document.getElementById('editAccount').style.display = 'block';
    document.getElementById('changePassword').style.display = 'none';
}

function showChangePassword() {
    document.getElementById('profile').style.display = 'none';
    document.getElementById('editAccount').style.display = 'none';
    document.getElementById('changePassword').style.display = 'block';
}