<form action="#" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Nazwa</label>
        <input type="text" id="name" class="form-control" name="name">
    </div>
    <?php use Service\FlashMessagesService; ?>
    <?php if (isset($_SESSION['e_name'])): ?>
        <?php FlashMessagesService::setFlashMessage('danger', $_SESSION['e_name']); ?>
        <?php unset($_SESSION['e_name']); ?>
    <?php endif; ?>
    <div class="form-group">
        <label for="cylinder">Liczba cylindrów</label>
        <input type="number" id="cylinder" class="form-control" name="cylinder">
    </div>
    <div class="form-group">
        <label for="capacity">Pojemność silnika</label>
        <input type="number" id="capacity" class="form-control" name="capacity">
    </div>
    <div class="form-group">
        <label for="power">Moc</label>
        <input type="number" id="power" class="form-control" name="power">
    </div>
    <div class="form-group">
        <label for="acceleration">Przyspieszenie</label>
        <input type="text" id="acceleration" class="form-control" name="acceleration">
    </div>
    <div class="form-group">
        <label for="speed">Prędkość maksymalna</label>
        <input type="number" id="speed" class="form-control" name="speed">
    </div>
    <div class="form-group">
        <input type="file" name="image"/>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Zapisz</button>
    </div>
</form>