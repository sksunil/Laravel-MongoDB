<!DOCTYPE html>
<html>
<body>

<h1>Add Books</h1>

<form method="POST" action="{{route('books.store')}}">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
   Isbn :<br>
  <input type="text" name="isbn" id="isbn">
  <br>
  Title:<br>
  <input type="text" name="title" id="title">
  <br><br>
  Author:<br>
  <input type="text" name="author" id="author">
  <br><br>
   Category:<br>
  <input type="text" name="category" id="category">
  <br><br>
  <input type="submit" value="Submit">
</form>


</body>
</html>
