<!-- Vista de login a partir de la plantilla AdminLTE 3.0 -->

<!-- Comprobación de usuario registrado, en caso afirmativo devuelve a la vista principal -->
@if (Auth::check())
    <?php redirect("/misdatos")?>
    
@else
    @extends('adminlte::auth.login')
@endif 

