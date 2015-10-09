<h1><?php if ( $this->uri->segment(4) == "install" ): ?>Install blog<?php else: ?>Uninstall blog<?php endif; ?></h1>

<p><?php if ( $this->uri->segment(4) == "install" ): ?>Install<?php else: ?>Uninstall<?php endif; ?> result: <?php echo (isset($install_result) ? $install_result : ""); ?></p>