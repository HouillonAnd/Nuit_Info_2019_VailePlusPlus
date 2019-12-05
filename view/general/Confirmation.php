<?php



if(isset($confirmation)){
  $msg = $confirmation;
} else {
  $msg = 'Action was succesfully done';
}

echo '<div class="row">
        <div class="col offset-m3 m6 errorCard">
          <div class="card-panel center-align green large">
            <h3 class="white-text"> Congrats : </h3>
            <h5 class="white-text">' . $msg . '
            </h5>
          </div>
        </div>
      </div>';


?>
