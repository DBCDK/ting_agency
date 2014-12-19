(function($) {

  function addTogglers(context) {
    $('[data-ting-agency-more-info-toggler]', context).click(function(e){
      var $target = $(e.target);
      if(!$target.hasClass('bibdk-favourite--add-remove-library')){
        $('.ting-agency--more-info', this).toggleClass('is-toggled');
      }
    });
  }

  Drupal.behaviors.tingAgency = {
    attach: function(context, settings) {
      addTogglers(context);
    }
  };
}(jQuery));
