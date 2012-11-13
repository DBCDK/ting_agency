<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="element-section visuallyhidden">
  <div class="library-details text clearfix">
    <div class="library-details-column-1">
      <?php if( isset($address) ) : ?>
      <p class="subheader"><strong><?php print t('ting_agency_address'); ?></strong></p>
      <p><?php print $address; ?></p>
      <?php endif; ?>
      <?php if( isset($contact) ) : ?>
      <p class="subheader"><strong><?php print t('ting_agency_contact'); ?></strong></p>
      <p><?php print $contact; ?></p>
      <?php endif; ?>
    </div> <!-- column-1 -->

    <div class="library-details-column-2">
      <?php if ( $openingHours != 'ting_agency_no_opening_hours' ) { ?>
        <p class="subheader"><strong><?php print t('ting_agency_opening_hours'); ?></strong></p>
        <p><?php print $openingHours; ?></p>
      <?php } ?>
      <?php if ( isset($tools) ) : ?>
        <p class="subheader"><strong><?php print t('ting_agency_tools'); ?></strong></p>
        <?php print $tools; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
