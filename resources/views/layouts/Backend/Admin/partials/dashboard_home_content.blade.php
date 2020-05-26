<!-- ============================================================== -->
            
                <!-- ============================================================== -->
                <!-- Stats box -->
                <!-- ============================================================== -->
                @if(Request::is('admin*'))
                <!--- Total Count Widget --->
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center"><img src="{{ asset('Backend/assets') }}/images/icon/income.png" alt="Income" /></div>
                                    <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Total Posts</h6>
                                        <h2 class="m-t-0">{{ $posts->count() }}</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center"><img src="{{ asset('Backend/assets') }}/images/icon/expense.png" alt="Income" /></div>
                                    <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Pending Post</h6>
                                        <h2 class="m-t-0">{{ $pendingPost }}</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center"><img src="{{ asset('Backend/assets') }}/images/icon/assets.png" alt="Income" /></div>
                                    <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Total Views</h6>
                                        <h2 class="m-t-0">{{ $allView }}</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="m-r-20 align-self-center"><img src="{{ asset('Backend/assets') }}/images/icon/staff.png" alt="Income" /></div>
                                    <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Total Categories</h6>
                                        <h2 class="m-t-0">{{ $category }}</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--- Populer Post with Author -->
                 <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                   <div class="card-body">
                                      <div class="d-flex">
                                        <div class="m-r-20 align-self-center"><img src="{{ asset('Backend/assets') }}/images/icon/income.png" alt="Income" /></div>
                                       <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Total Author</h6>
                                        <h2 class="m-t-0">{{ $user }}</h2></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                   <div class="card-body">
                                      <div class="d-flex">
                                        <div class="m-r-20 align-self-center"><img src="{{ asset('Backend/assets') }}/images/icon/income.png" alt="Income" /></div>
                                       <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Active Author</h6>
                                        <h2 class="m-t-0">{{ $activAuthor->count() }}</h2></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                   <div class="card-body">
                                      <div class="d-flex">
                                        <div class="m-r-20 align-self-center"><img src="{{ asset('Backend/assets') }}/images/icon/income.png" alt="Income" /></div>
                                       <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Total Tag</h6>
                                        <h2 class="m-t-0">{{ $tag }}</h2></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                               <div class="card">
                                   <div class="card-body">
                                      <div class="d-flex">
                                        <div class="m-r-20 align-self-center"><img src="{{ asset('Backend/assets') }}/images/icon/income.png" alt="Income" /></div>
                                       <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Total Subscribers</h6>
                                        <h2 class="m-t-0">{{ $subscribers->count() }}</h2></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-title">
                                <h3>Most Populer Post:)</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                   <table class="table table-bordered table-striped">
                                    <thead>
                                      <tr>
                                        <td>Post Author</td>
                                        <td>post view</td>
                                        <td>Title</td>
                                     </tr>
                                    </thead>
                                   <tbody>
                                     {{-- @php 
                                     use Illuminate\Support\str;
                                     @endphp --}}
                                     @foreach($popularPost as $post)
                                     <tr>
                                     <td>{{ $post->user->name }}</td>
                                     <td>{{ $post->view_count }}</td>
                                     <td>
                                         {{ $post->title }}
                                     </td>
                                    </tr>    
                                   @endforeach
                                  </tbody>
                                </table>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- ============================================================== -->
                <!-- Sales overview chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h3 class="card-title m-b-5"><span class="lstick"></span>Total Visits </h3>
                                    </div>
                                    <div class="ml-auto">
                                        <select class="custom-select b-0">
                                            <option selected="">January 2017</option>
                                            <option value="1">February 2017</option>
                                            <option value="2">March 2017</option>
                                            <option value="3">April 2017</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="visitfromworld" style="width:100%!important; height:415px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><span class="lstick"></span>Browser Stats</h4>
                                <table class="table browser m-t-30 no-border">
                                    <tbody>
                                        <tr>
                                            <td style="width:40px"><img src="{{ asset('Backend/assets') }}/images/browser/chrome-logo.png" alt=logo /></td>
                                            <td>Google Chrome</td>
                                            <td class="text-right">23%</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('Backend/assets') }}/images/browser/firefox-logo.png" alt=logo /></td>
                                            <td>Mozila Firefox</td>
                                            <td class="text-right">15%</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('Backend/assets') }}/images/browser/safari-logo.png" alt=logo /></td>
                                            <td>Apple Safari</td>
                                            <td class="text-right">07%</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('Backend/assets') }}/images/browser/internet-logo.png" alt=logo /></td>
                                            <td>Internet Explorer</td>
                                            <td class="text-right">09%</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('Backend/assets') }}/images/browser/opera-logo.png" alt=logo /></td>
                                            <td>Opera mini</td>
                                            <td class="text-right">23%</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('Backend/assets') }}/images/browser/edge-logo.png" alt=logo /></td>
                                            <td>Microsoft edge</td>
                                            <td class="text-right">09%</td>
                                        </tr>
                                        <tr>
                                            <td><img src="{{ asset('Backend/assets') }}/images/browser/netscape-logo.png" alt=logo /></td>
                                            <td>Netscape Navigator</td>
                                            <td class="text-right">04%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->