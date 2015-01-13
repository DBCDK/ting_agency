(function($) {

  function addTogglers(context) {
    $('[data-ting-agency-more-info-toggler]', context).click(function(e){
      var $target = $(e.target);
      if(!$target.hasClass('bibdk-favourite--add-remove-library') && !$target.hasClass('agencylist-link')){
        $('.ting-agency--more-info', this).toggleClass('is-toggled');
        $('.ting-agency--more-info-toggle-indicator', this).toggleClass('is-toggled');
      }
    });
  }

  Drupal.behaviors.tingAgency = {
    attach: function(context, settings) {
      addTogglers(context);
    }
  };
}(jQuery));
