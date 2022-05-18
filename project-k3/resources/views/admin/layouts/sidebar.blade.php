<script>
  function myFunction() {
  document.getElementById("demo").innerHTML = "active";
}
</script>

<ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('list-users') }}">Users</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('list-categories') }}">Categories</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('list-posts') }}">Posts</a>
      </li>
  </ul>
  
 