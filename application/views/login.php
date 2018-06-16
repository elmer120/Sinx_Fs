<h2><?php if (isset($title)) {echo $title;} ?></h2>




<div class="uk-grid-small" uk-grid> <!-- inizio griglia small gutter-->

    <div class="uk-width-1-4"> 
    </div>


    <div class="uk-width-1-2"> 
    <img class="uk-background-contain uk-background-center-center" src="<? echo base_url("assets/img/login_background.svg");?>" alt="Sinx"/>
        <div class="uk-container uk-position-center">
            <div class="uk-card uk-card-default ">
                <div class="uk-card-badge uk-label uk-text-lowercase"><?php echo lang('version');?></div>
                <div class="uk-card-media-top">
                    <img class="uk-height-small uk-height-max-small" src="<? echo base_url("assets/img/logo.png");?>" alt="Sinx"/>
                </div>
                <div class="uk-card-body">
                    <?php echo form_open('login/login_user','class="uk-form-horizontal"'); //mando i dati al controller?> 
                    <label class="uk-form-label">Username</label>
                <div class="uk-form-controls uk-margin">
                    <input class="uk-input uk-form-width-medium" type="text" name="username" required/><br />
                </div>

                    <label class="uk-form-label">Password</label>
                <div class="uk-form-controls uk-margin">
                    <input class="uk-input uk-form-width-medium" type="password" name="password" value="admin" required></input><br />
                </div>
                    <label class="uk-form-label">Lingua</label>
                <div class="uk-form-controls uk-margin uk-form-controls-text">
                    <label><input class="uk-radio" type="radio" name="lang" checked> ita</label>
                    <label><input class="uk-radio" type="radio" name="lang"> eng</label>
                </div>

                <input  class="uk-button uk-button-default uk-width-1-1" type="submit" name="submit" value="Accedi" />

                <label><?if (isset($error)){echo $error;}?></label>

                <?php echo validation_errors(); ?>
                </div>
                
            </div>
            </form>
        </div>
    </div>


    <div class="uk-width-1-4"> 
    </div>

</div>