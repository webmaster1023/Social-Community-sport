<div class="space-15">
    <?php echo $this->Form->create('HockeyPrediction', array('url' => array('controller' => 'Games', 'action' => 'hockeyPrediction'), "class" => "form-horizontal")); ?>
    <div class="row predicdion-box before-radio" id="before_radio">
        <?php echo $this->element('sports/sport_prediction'); ?>
    </div>
    <div class="row predicdion-box  after-radio" id="after_radio">
        <div class="col-lg-12 text-right goback" style="margin-bottom:20px;"><?php echo __dbt("Go Back");?></div>
        
        <div class="col-lg-12" id="innhtmlhere"></div>
        <div class="col-sm-6"><?php echo $this->Form->input('first_team_goals', array('class' => 'inbox form-control',)); ?></div>
        <div class="col-sm-6"><?php echo $this->Form->input('second_team_goals', array('class' => 'inbox form-control',)); ?></div>
        <div class="col-sm-6">&nbsp;</div>
        <div class="col-sm-6">
            <?php echo '&nbsp;' . $this->Form->submit(__dbt('Save Prediction'), array('type' => 'submit', 'class' => 'btn from-btn', 'div' => false)); ?>
            <?php echo $this->Form->input('sport_id', array('value' => $sportId, 'type' => 'hidden')); ?>
            <?php echo $this->Form->input('game_id', array('value' => $gameId, 'type' => 'hidden')); ?>
            <?php echo $this->Form->input('league_id', array('value' => $leagueId, 'type' => 'hidden')); ?>
            <?php echo $this->Form->input('tournament_id', array('value' => $tournamentId, 'type' => 'hidden')); ?>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
<script>
    $("#HockeyPredictionHockeyPredictionForm").validate({
        rules: {
            "data[HockeyPrediction][first_team_goals]": {
                required: true,
                digits: true,
            },
            "data[HockeyPrediction][second_team_goals]": {
                required: true,
                digits: true,
            }
        },
        messages: {
            "data[HockeyPrediction][first_team_goals]": {
                required: "<?php echo __dbt('Please Enter Score.'); ?>",
                digits: "<?php echo __dbt('Integers only.'); ?>",
            },
            "data[HockeyPrediction][second_team_goals]": {
                required: "<?php echo __dbt('Please Enter Score.'); ?>",
                digits: "<?php echo __dbt('Integers only.'); ?>",
            }
        }
    });
</script>
