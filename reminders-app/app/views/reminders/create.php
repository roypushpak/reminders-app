<!-- Form looks like user signup, takes in subject, button that says create, added to reminders table and automatically add user_id. -->
<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
  <div class="text-center">
    <h1 class="display-5">Create a new reminder</h1>
  </div>
  <form action="/reminders/create" method="post">
    <div>
      <label for="subject" class="form-label">Subject:</label>
      <input class="form-control" name="subject" type="text" id="subject" required>
    </div>
    <br>
    <div class="text-center">
      <button class="btn btn-dark" type="submit">Create</button>
    </div>
  </form>
</div>
<br>
<?php require_once 'app/views/templates/footer.php' ?>