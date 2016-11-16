<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	Bạn là admin của 1 khoa
	 {{ Auth::user()->role}} 
	 <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
</body>
</html>