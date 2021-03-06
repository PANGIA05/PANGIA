// Generated by CoffeeScript 1.6.3
(function() {
  jQuery(function() {
    var $, configureMenus, menu, menuTrigger;
    $ = jQuery;
    menuTrigger = $('#ls-trigger');
    menu = $.offCanvasMenu({
      direction: 'left',
      coverage: '220px'
    });
    (configureMenus = function(display) {
      switch (display) {
        case 'block':
          menu.on();
          break;
        case 'none':
          menu.off();
          break;
        default:
          return;
      }
    })(menuTrigger.css('display'));
    menuTrigger.csswatch({
      props: 'display'
    }).on('css-change', function(event, change) {
      return configureMenus(change.display);
    });
    return FastClick.attach(document.body);
  });

}).call(this);