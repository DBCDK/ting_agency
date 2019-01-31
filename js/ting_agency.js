(function($) {

  function addTogglers(context) {
    $("[data-ting-agency-more-info-toggler]", context).once("agency").click(function(e) {
      var self = $(this);
      var target = $(e.target);
      if(!target.hasClass("bibdk-favourite--add-remove-library") &&
          !target.hasClass("agencylist-link")) {
        self.next(".ting-agency--more-info").toggleClass("is-toggled");
        self.next(".ting-agency--more-info-toggle-indicator").toggleClass("is-toggled");
      }
    });
  }

  Drupal.behaviors.tingAgency = {
    attach: function(context, settings) {
      addTogglers(context);
    }
  };
}(jQuery));
