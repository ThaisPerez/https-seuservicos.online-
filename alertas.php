<?php
if ( isset($_SESSION['type']) && !empty($_SESSION['type']) && isset($_SESSION['message']) && !empty($_SESSION['message']) ) {
    echo '
    <div class="row">
        <div class="col-12">
            <div class="alert alert-' . $_SESSION['type'] . '" role="alert">
            ' . $_SESSION['message'] . '
            </div>
        </div>
    </div>
    ';

    unset($_SESSION['type']);
    unset($_SESSION['message']);
}