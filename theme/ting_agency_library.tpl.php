<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<article class="<?php print $classes; ?>" data-ting-agency-more-info-toggler>
  <div class="element-section clearfix">
    <div class="ting-agency--header">
      <span class="ting-agency--branch-name"><?php print $branchName; ?></span>
      <?php if (!empty($agencyName)) : ?>
        <span class="ting-agency--agency-name"><?php print $agencyName; ?></span>
        <?php if (!empty($temporarilyClosedReason)) : ?>
          <strong><br/><?php print $temporarilyClosedReason; ?></strong>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <?php if (!empty($actions)) : ?>
      <div class="ting-agency--actions"><?php print $actions; ?></div>
    <?php endif; ?>
    <div class="messages_<?php print $branchid ?> clearfix"></div>
  </div>
  <?php if (!empty($moreinfo)): ?>
    <div class="element-section ting-agency--more-info">
      <?php print $moreinfo; ?>
    </div>
  <?php endif; ?>
</article>