<!DOCTYPE html>
<html>
<head>
   
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>

    <environment include="Development">
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="~/css/site.css" />
       

    </environment>
    <environment exclude="Development">
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/bootstrap/3.3.7/css/bootstrap.min.css"
              asp-fallback-href="~/lib/bootstrap/dist/css/bootstrap.min.css"
              asp-fallback-test-class="sr-only" asp-fallback-test-property="position" asp-fallback-test-value="absolute" />
        <link rel="stylesheet" href="~/css/site.min.css" asp-append-version="true" />
        

    </environment>
</head>
<body>
    <header>
        <!-- Common header content goes here -->
       
    </header>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
            <img src="{{ asset('images/icon.gif') }}" alt="Logo" style="height:40px">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
.                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a asp-page="/Index" class="navbar-brand">qBD</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/counters">Counters</a></li>
                    <li><a href="/booths">Booths</a></li>
                    <li><a href="/tokenTypes">Token Types</a></li>
                    <li><a href="/user-roles">User Control</a></li>
                  
                </ul>
            </div>
        </div>

        
    </nav>
    <br/>
    <div>
        <div style="margin-top: 225px;">

        @yield('content')

    </div>
    </div>

    <footer>
        <!-- Common footer content goes here -->
    </footer>
</body>
</html>
