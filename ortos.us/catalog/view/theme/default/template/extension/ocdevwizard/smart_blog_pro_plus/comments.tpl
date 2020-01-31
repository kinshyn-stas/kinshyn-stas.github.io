<?php foreach ($comments as $comment) { ?>
  <div>
    <?php if ($comment['thumb']) { ?>
      <div class="comment-image">
        <div>
          <img src="<?php echo $comment['thumb']; ?>"/>
          <button type="button" title="<?php echo $button_respond_to_comment; ?>" onclick="<?php echo $_code; ?>_respond('<?php echo $comment['comment_id']; ?>', this)"><i class="fa fa-reply" aria-hidden="true"></i></button>
        </div>
      </div>
    <?php } ?>
    <div class="comment-inner">
      <div>
        <div class="comment-name">
          <?php echo $comment['firstname']; ?>
          <div class="comment-date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $comment['date_added']; ?></div>
        </div>
        <div class="comment-description"><?php echo $comment['description']; ?></div>
      </div>
      <div class="comment-vote">
        <div><span id="<?php echo $_code; ?>-vote-down-<?php echo $comment['comment_id']; ?>"><?php echo $comment['total_vote_down']; ?></span> / <span id="<?php echo $_code; ?>-vote-up-<?php echo $comment['comment_id']; ?>"><?php echo $comment['total_vote_up']; ?></span></div>
        <div>
          <button type="button" onclick="<?php echo $_code; ?>_vote('<?php echo $comment['comment_id']; ?>', 'down', 'comment', this)"><i class="fa fa-thumbs-down" aria-hidden="true"></i></button>
          <button type="button" onclick="<?php echo $_code; ?>_vote('<?php echo $comment['comment_id']; ?>', 'up', 'comment', this)"><i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>
  <?php if ($comment['responds']) { ?>
    <?php foreach ($comment['responds'] as $respond) { ?>
      <div class="comment-responds-block">
        <?php if ($respond['thumb']) { ?>
        <div class="comment-image">
          <div>
            <img src="<?php echo $respond['thumb']; ?>"/>
          </div>
        </div>
        <?php } ?>
        <div class="comment-inner">
          <div>
            <div class="comment-name">
              <?php echo $respond['firstname']; ?>
              <div class="comment-date"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $respond['date_added']; ?></div>
            </div>
            <div class="comment-description"><?php echo $respond['description']; ?></div>
          </div>
        </div>
      </div>
    <?php } ?>
  <?php } ?>
<?php } ?>