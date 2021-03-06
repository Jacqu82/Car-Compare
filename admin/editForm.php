<?php $object = isset($car) ? $car : $motorCycle; ?>

<form action="#" method="post">
    <div class="form-group">
        <label for="name">Nazwa</label>
        <input type="text" id="name" class="form-control" name="name" value="<?php echo $object->getName(); ?>">
    </div>
    <?php use Service\FlashMessagesService; ?>
    <?php if (isset($_SESSION['e_name'])): ?>
        <?php FlashMessagesService::setFlashMessage('danger', $_SESSION['e_name']); ?>
        <?php unset($_SESSION['e_name']); ?>
    <?php endif; ?>
    <div class="form-group">
        <label for="cylinder">Liczba cylindrów</label>
        <input type="number" id="cylinder" class="form-control" name="cylinder"
               value="<?php echo $object->getNumberOfCylinders(); ?>">
    </div>
    <div class="form-group">
        <label for="capacity">Pojemność silnika</label>
        <input type="number" id="capacity" class="form-control" name="capacity"
               value="<?php echo $object->getEngineCapacity(); ?>">
    </div>
    <div class="form-group">
        <label for="power">Moc</label>
        <input type="number" id="power" class="form-control" name="power" value="<?php echo $object->getPower(); ?>">
    </div>
    <div class="form-group">
        <label for="acceleration">Przyspieszenie</label>
        <input type="text" id="acceleration" class="form-control" name="acceleration"
               value="<?php echo $object->getAcceleration(); ?>">
    </div>
    <div class="form-group">
        <label for="speed">Prędkość maksymalna</label>
        <input type="number" id="speed" class="form-control" name="speed"
               value="<?php echo $object->getTopSpeed(); ?>">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-warning">Edytuj</button>
    </div>
</form>