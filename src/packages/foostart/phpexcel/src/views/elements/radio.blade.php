<!-- SAMPLE INPUT NAME -->
<div class="form-group">

    {!! Form::label($name, 'Status:') !!}

    <?php
        $locked = 0;
        $running = 1;
    ?>
    <fieldset> 

        <input type="radio" value="<?php echo $locked ?>" name="api_status" checked>Locked
        <input type="radio" value="<?php echo $running ?>" name="api_status" <?php if ($running == $api->api_status) echo 'checked' ?>>Running
        
    </fieldset>

</div>
<!-- /END SAMPLE INPUT NAME -->