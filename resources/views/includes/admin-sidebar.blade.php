<div class="img bg-wrap text-center py-4" style="background-image: url(images/bg_1.jpg);">
    <div class="user-logo">
        <div class="img" style="background-image: url(images/logo.jpg);"></div>
        <h3>{{ Auth::user()->getFullName() }}</h3>
    </div>
</div>
<ul class="list-unstyled components mb-5">
    <li>
        <a href="#"><span class="fa fa-home mr-3"></span> Acceuil</a>
    </li>
    <li>
        <a href="{{ route('admin.manage_posts') }}"><span class="fa fa-file mr-3 notif"><small class="d-flex align-items-center justify-content-center">{{ App\Models\Post::where('is_published', false)->count() }}</small></span> Gérer les posts</a>
    </li>
    <li>
        <a href="{{ route('admin.manage_categories') }}"><span class="fa fa-gift mr-3"></span> Gérer les catégories</a>
    </li>
    <li>
        <a href="{{ route('admin.manage_users') }}"><span class="fa fa-trophy mr-3"></span> Gérer les utilisateurs</a>
    </li>
    <li>
        <a href="{{ route('admin.manage_contacts') }}"><span class="fa fa-message mr-3"></span> Gérer les messages</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-cog mr-3"></span> Settings</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-support mr-3"></span> Support</a>
    </li>
    <li>
        <a href="#"><span class="fa fa-sign-out mr-3"></span> Sign Out</a>
    </li>
</ul>