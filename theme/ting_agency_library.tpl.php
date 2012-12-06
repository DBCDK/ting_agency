<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<article class="<?php print $classes ?>" >
  <div class="element-section clearfix">
    <div class="actions">
      <?php print $actions; ?>
    </div>
    <hgroup>
      <h3><?php print $branchName; ?></h3> 
      <?php if(isset($agencyName) ) :?>
      <h4><?php print $agencyName;?></h4>
      <?php endif;?>      
    </hgroup>
    <div class="messages_<?php print $branchid ?>"></div>
    <?php if (isset($moreinfo)) : ?>
      <div class="toggle-next-section">
        <a href="#" class="show-more">
          <strong><?php print t('ting_agency_more_info'); ?></strong>
        </a>
        <a href="#" class="show-less visuallyhidden">
          <strong><?php print t('ting_agency_less_info'); ?></strong>
        </a>
      </div>
    </div>
    <?php print $moreinfo; ?>
  <?php endif; ?>
</article>


