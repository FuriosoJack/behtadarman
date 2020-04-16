<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap">
    <h2 style="margin-bottom: 20px;">فونت پوسته</h2>
    <?php
    //show saved options message
    if (isset($_GET['settings-updated'])) : ?>
        <br/><br/><div id="message" class="updated below-h2 notice is-dismissible"><p><?php _e('تنظیمات با موفقیت ذخیره شد.', 'awp'); ?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e('Close', 'awp'); ?></span></button></div>
    <?php endif; ?>
    <form method="post" action="options.php">
        <?php settings_fields('ariafontxstore_font_settings'); ?>
        <?php $options = get_option('ariafontxstore_font_settings'); ?>
        
        <hr/>
        <table class="form-table">
            <h3><?php _e('فونت های قالب ایکس استور', 'awp'); ?></h3>
            <p>
                از بخش زیر فونت هایی را که قصد دارید در قالب آنکد استفاده کنید، انتخاب بفرمایید.
            </p>
            <p>
                <strong>توجه:</strong> برای کاهش حجم صفحه و افزایش سرعت بارگذاری وبسایت توصیه می شود فقط از یک یا نهایتا دو فونت استفاده کنید.
            </p>
            <?php

            for ($i=1; $i <= 4; $i++){ ?>
                <?php
                $fontnamecount = 'fontname' . $i;
                ?>
            <tr valign="top">
                <th scope="row"><?php echo "نام فونت " . $i; ?></th>
                <td>
                    <select name="ariafontxstore_font_settings[fontname<?php echo $i; ?>]" id="ariafontxstore_font_settings[fontname]">
                        <option value=""><?php _e('هیچ کدام', 'awp'); ?></option>
                        <optgroup label="<?php _e('فونت های پارسی', 'awp'); ?>">
                            <option <?php echo ($options[$fontnamecount] == "iransans" ? "selected ":""); ?> value="iransans">IRANSans</option>
                            <option <?php echo ($options[$fontnamecount] == "iransansfanum" ? "selected ":""); ?> value="iransansfanum">IRANSansFaNum</option>
                            <option <?php echo ($options[$fontnamecount] == "iransansdn" ? "selected ":""); ?> value="iransansdn">iransansdn</option>
                            <option <?php echo ($options[$fontnamecount] == "iransansdnfanum" ? "selected ":""); ?> value="iransansdnfanum">iransansdnFaNum</option>
                            <option <?php echo ($options[$fontnamecount] == "mahboubeh-mehravar" ? "selected ":""); ?> value="mahboubeh-mehravar">mahboubeh_mehravar</option>
                            <option <?php echo ($options[$fontnamecount] == "iranyekan" ? "selected ":""); ?> value="iranyekan">iranyekan</option>
                            <option <?php echo ($options[$fontnamecount] == "iranyekanfanum" ? "selected ":""); ?> value="iranyekanfanum">iranyekanFaNum</option>
                            <option <?php echo ($options[$fontnamecount] == "Yekan" ? "selected ":""); ?> value="Yekan">Yekan</option> 
                            <option <?php echo ($options[$fontnamecount] == "droidarabicnaskh" ? "selected ":""); ?> value="droidarabicnaskh">Droid Arabic Naskh</option>
                            <option <?php echo ($options[$fontnamecount] == "droidarabickufi" ? "selected ":""); ?> value="droidarabickufi">Droid Arabic Kufi</option>

                        </optgroup>
                        
                    </select>
                    <p class="description"><?php _e('لطفا فونت خود را انتخاب کنید.', 'awp'); ?></p></td>
            </tr>
            <?php } ?>
            
        </table>
        
        <hr/>
        <!-- Form Class -->
        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('ذخیره تغییرات', 'awp'); ?>" />
        </p>
    </form>
</div>
