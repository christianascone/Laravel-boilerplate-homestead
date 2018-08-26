<li class="{{ Request::is('configurations*') ? 'active' : '' }}">
    <a href="{!! route('configurations.index') !!}"><i class="fa fa-edit"></i><span>Settings</span></a>
</li>

<li class="{{ Request::is('quizzes*') ? 'active' : '' }}">
    <a href="{!! route('quizzes.index') !!}"><i class="fa fa-edit"></i><span>Quizzes</span></a>
</li>

