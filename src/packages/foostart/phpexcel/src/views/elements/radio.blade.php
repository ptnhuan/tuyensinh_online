<!-- SAMPLE INPUT NAME -->
<div class="form-group">

    {!! Form::label($name, 'Status:') !!}

    <?php
        $locked = 0;
        $running = 1;
    ?>
    <fieldset>

        <input type="radio" value="<?php echo $locked ?>" name="phpexcel_status" checked>Locked
        <input type="radio" value="<?php echo $running ?>" name="phpexcel_status" <?php if ($running == $phpexcel->phpexcel_status) echo 'checked' ?>>Running

    </fieldset>

</div>
<!-- /END SAMPLE INPUT NAME -->