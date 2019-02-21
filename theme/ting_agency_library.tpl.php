<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<article class="<?php print $classes; ?>">
    <div class="element-section clearfix" data-ting-agency-more-info-toggler>
        <div class="ting-agency--header">
            <h2 class="ting-agency--branch-name"><?php print $branchName; ?></h2>
            <span class="ting-agency--more-info-toggle-indicator"></span>
          <?php if (!empty($agencyName)) : ?>
              <span class="ting-agency--agency-name"><?php print $agencyName; ?></span>
          <?php endif; ?>
          <?php if (!empty($temporarilyClosedReason)) : ?>
              <strong><br/><?php print $temporarilyClosedReason; ?></strong>
          <?php endif; ?>
        </div>
      <?php if (!empty($actions)) : ?>
          <div class="ting-agency--actions"><?php print $actions; ?></div>
      <?php endif; ?>
        <div class="messages-<?php print $branchid ?> clearfix"></div>
    </div>
  <?php if (!empty($moreinfo)): ?>
      <div class="element-section ting-agency--more-info">
        <?php print drupal_render($moreinfo); ?>
      </div>
  <?php endif; ?>
</article>
