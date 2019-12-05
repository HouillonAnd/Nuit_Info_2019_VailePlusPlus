<?php



if(isset($error)){
  $msg = $error;
} else {
  $msg = 'A fatal error has occured';
}

echo '<div class="row">
        <div class="col offset-m3 m6 errorCard">
          <div class="card-panel center-align red large">
            <h3 class="white-text"> Error : </h3>
            <h5 class="white-text">' . $msg . '
            </h5>
          </div>
        </div>
      </div>';


?>
