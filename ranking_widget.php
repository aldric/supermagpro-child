<div class="exampleWidget">
<h3 class="widget-title">
  <span>Notre avis</span>
</h3>


<div class="pricing animated swing">
  <div>
      <div class="c100 p<?php echo $eval_mean; ?> center green">
          <span>
             <?php echo $eval_mean.'%'; ?>
          </span>
          <div class="slice">
              <div class="bar"></div>
              <div class="fill"></div>
          </div>
      </div>
  </div>
  <div class='title'>
      <?php /*echo $eval_title;*/ echo $bank_name_label; ?>
  </div>
  <div class='content'>
      <ul>
           <?php foreach ($eval_data as $row) : ?>
          <li>
              <div class="row">
                  <div class="col-xs-12 col-md-7">
                      <div>
                          <strong>
                              <?php echo $row['label']; ?>
                          </strong>
                      </div>
                      <div>
                          <small>
                              <?php echo $row['description']; ?>
                          </small>
                      </div>

                  </div>
                  <div class="col-xs-12 col-md-5">
                      <input value="<?php echo $row['note']; ?>" class="rating-loading" data-rating />
                  </div>
              </div>
          </li>
          <?php endforeach; ?>
      </ul>
      <a href='https://www.elegantthemes.com/cgi-bin/members/register.cgi?sub=16'>
          Visiter le site
      </a>
  </div>
</div>
</div>
<script>
jQuery(document).on('ready', function () {
jQuery('#input-note-general').rating({ displayOnly: true, step: 1, min: 0, max: 100 });
});
jQuery(document).on('ready', function () {
jQuery('input[data-rating]').rating({ displayOnly: true, step: 1, min: 0, max: 100, size: 'xxs' });
});
</script>
