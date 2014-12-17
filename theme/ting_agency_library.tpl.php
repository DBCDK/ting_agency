<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<article class="<?php print $classes ?>">
  <div class="element-section clearfix">
    <div class="hgroup<?php print !empty($actions) ? ' has-action' : ''; ?>">
      <span class="ting-agency-branch-name"><?php print $branchName; ?></span>

      <?php if (!empty($agencyName)) : ?>
        <span class="ting-agency-agency-name"><?php print $agencyName; ?></span>
        <?php if (!empty($temporarilyClosedReason)) : ?>
          <strong><br/><?php print $temporarilyClosedReason; ?></strong>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <?php if (!empty($actions)) : ?>
      <?php print $actions; ?>
    <?php endif; ?>
    <div class="messages_<?php print $branchid ?> clearfix"></div>
    <?php if (isset($moreinfo) and $toggle_enabled == true) : ?>
    <div class="toggle-next-section">
      <a href="#" class="show-more">
        <strong><?php print t('ting_agency_more_info'); ?></strong>
      </a>
      <a href="#" class="show-less visuallyhidden">
        <strong><?php print t('ting_agency_less_info'); ?></strong>
      </a>
    </div>
  </div>
  <?php endif; ?>
  <?php if (!empty($moreinfo)): ?>
    <?php print $moreinfo; ?>
  <?php endif; ?>
</article>


