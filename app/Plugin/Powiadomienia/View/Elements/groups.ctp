<?php if ($groups) {
    foreach ($groups as $index => $group) {
        ?>
        <li class="<?php if (isset($this->request->query['group_id']) == false || $this->request->query['group_id'] == $group['PowiadomieniaGroup']['id']) echo 's'; ?><?php if ($group['PowiadomieniaGroup']['alerts_unread_count']) { ?> nonzero<?php } ?>"
            data-id="<?php echo $group['PowiadomieniaGroup']['id']; ?>"
            title="<?php echo str_replace('"', '', $group['PowiadomieniaGroup']['title']); ?>">
            <div class="inner radio-inline">
                <input type="radio" name="data[Dataobject][ids]"
                       id="PowiadomieniaFrazaId<?php echo $index ?>"
                       value="<?php echo $group['PowiadomieniaGroup']['id']; ?>"
                    <?php echo (isset($this->data['Dataobject']['ids']) && $this->data['Dataobject']['ids'] == $group['PowiadomieniaGroup']['id']) ? 'checked' : null; ?>/>
                <label for="PowiadomieniaFrazaId<?php echo $index ?>">
                    <a class="wrap"
                        <?php if (isset($this->request->query['group_id']) && ($this->request->query['group_id'] == $group['PowiadomieniaGroup']['id'])) { ?>
                            href="<?php echo $this->Html->url(array("controller" => "powiadomienia", "action" => "index", "?" => array("mode" => (isset($this->request->query['mode'])) ? $this->request->query['mode'] : null))) ?>"
                        <?php } else { ?>
                            href="<?php echo $this->Html->url(array("controller" => "powiadomienia", "action" => "index", "?" => array("group_id" => $group['PowiadomieniaGroup']['id'], "mode" => (isset($this->request->query['mode'])) ? $this->request->query['mode'] : null))) ?>"
                        <?php } ?>
                       target="_self">
                        <?php echo $group['PowiadomieniaGroup']['title']; ?>
                    </a>

                    <div class="count">
                        <span
                            class="badge<?php if ($group['PowiadomieniaGroup']['alerts_unread_count'] > 0) { ?> nonzero<?php } ?>">
                            <?= $group['PowiadomieniaGroup']['alerts_unread_count']; ?>
                        </span>
                    </div>
                    <a href="#options" class="options" data-icon="&#xe612;">
                    </a>
                </label>
            </div>
        </li>
    <?
    }
} ?>

<span class="nokeywords<?php if ($groups != null) {
    echo ' hidden';
} ?>"><?php echo __d('powiadomienia', "LC_POWIADOMIENIA_FRAZY_NOKEYWORDS") ?><span>