<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-profile"> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><img src="{{ asset('Backend/assets/images/profile/'. Auth::user()->profile) }}" alt="user" class="light-logo" /><span class="hide-menu">{{ Auth::user()->name }}</span></a>
                            <ul aria-expanded="false" class="collapse">

                                @if(Request::is('admin*'))
                                <li>
                                    <a href="{{ route('admin.user.profile') }}">My Profile </a>
                                </li>
                                @endif

                                @if(Request::is('author*'))
                                <li>
                                    <a href="{{ route('author.user.profile') }}">My Profile </a>
                                </li>
                                @endif
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i>
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @if(Request::is('admin*'))
                        <li class="nav-devider"></li>
                        <li> <a class="waves-effect waves-dark" href="{{ route('admin.dashboard') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span>Dashboard</span></a>
                        </li>
                        @endif
                        @if(Request::is('author*'))
                        <li class="nav-devider"></li>
                        <li> <a class="waves-effect waves-dark" href="{{ route('author.dashboard') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span>Dashboard</span></a>
                        </li>
                        @endif
                    <!---- Admin Related Menu Start ---->
                       @if(Request::is('admin*'))

                       <li class="nav-small-cap">Author List!</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-pencil-alt"></i><span class="hide-menu">Author!
                         <span class="label label-rouded label-primary pull-right">1</span>
                        </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('admin.author.index') }}">View Author</a></li>
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class=" fas fa-plus"></i><span class="hide-menu">Subscribers!
                         <span class="label label-rouded label-info pull-right">1</span>
                        </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('admin.subscriber.index') }}">View Subscriber</a></li>
                            </ul>
                        </li>

                       <li class="nav-small-cap">Blog Elements!</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-share-square"></i><span class="hide-menu">Tags!
                         <span class="label label-rouded label-info pull-right">2</span>
                        </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('admin.tag.create') }}">Add Tag</a></li>
                                <li><a href="{{ route('admin.tag.index') }}">View Tag</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-list"></i><span class="hide-menu">Categories!
                            <span class="label label-rouded label-primary pull-right">2</span>
                        </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('admin.category.create') }}">Add Category</a></li>
                                <li><a href="{{ route('admin.category.index') }}">View Category</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fas fa-magic"></i><span class="hide-menu">Posts!
                            <span class="label label-rouded label-success pull-right">4</span>
                        </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('admin.post.create') }}">Add Post</a></li>
                                <li><a href="{{ route('admin.post.index') }}">View Post</a></li>
                                <li><a href="{{ route('admin.post.approve.list') }}">Post Approvel List</a></li>
                                <li><a href="{{ route('admin.favourite.list') }}">Favourite List</a></li>
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Comments!
                            <span class="label label-rouded label-info pull-right">1</span>
                        </span></a>
                            <ul aria-expanded="false" class="collapse">
                              <li><a href="{{ route('admin.comment.index') }}">View Comments</a></li>
                            </ul>
                        </li>
                        @endif
                     <!---- Admin Related Menu End ---->

                     <!---- Author Related Menu Start ---->
                    @if(Request::is('author*'))
                      <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Posts!
                            <span class="label label-rouded label-success pull-right">3</span>
                        </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('author.post.create') }}">Add Post</a></li>
                                <li><a href="{{ route('author.post.index') }}">View Post</a></li>
                                <li><a href="{{ route('author.favourite.list') }}">Favourite List</a></li>
                            </ul>
                        </li>

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Comments!
                            <span class="label label-rouded label-success pull-right">1</span>
                        </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('author.comment.index') }}">View Comments</a></li>
                            </ul>
                        </li>
                      @endif
                     <!---- Author Related Menu End ---->
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
