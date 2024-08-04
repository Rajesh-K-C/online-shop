@extends('layouts.backend_master')

@section('title', 'Setting Details')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Setting Management</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div style="display: flex; justify-content: space-between; align-items: center">
                    <h6 class="m-0 font-weight-bold text-primary">Setting Details</h6>
                    <div>
                        <a href="{{route('backend.setting.create')}}" class="btn btn-primary ml-1">Create</a>
                        <a href="{{route('backend.setting.index')}}" class="btn btn-secondary ml-1">List</a>
                        <a href="{{ route('backend.setting.edit', $data['record']->id) }}"
                           class="btn btn-warning mr-1">Edit</a>
                        <form style="display: inline-block"
                              action="{{route('backend.setting.destroy', $data['record']->id)}}"
                              method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.flash_message')
                <table class="table  table-bordered">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{$data['record']->id}}</td>
                    </tr>
                    <tr>
                        <th>Setting Name</th>
                        <td>{{$data['record']->setting_name}}</td>
                    </tr>
                    <tr>
                        <th>Website Name</th>
                        <td>{{$data['record']->website_name}}</td>
                    </tr>
                    <tr>
                        <th>Slogan</th>
                        <td>{{$data['record']->slogan}}</td>
                    </tr>
                    <tr>
                        <th>Favicon</th>
                        <td>
                            <img {{$data['record']->favicon ? '' : 'style="display: none;"'}}
                                 src="{{asset('assets/images/setting/' . $data['record']->favicon)}}"
                                 id="logo_file_preview" style="width: min(4rem,100%)" alt="">
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <th>Logo</th>
                        <td>
                            <img {{$data['record']->logo ? '' : 'style="display: none;"'}}
                                 src="{{asset('assets/images/setting/' . $data['record']->logo)}}"
                                 id="logo_file_preview"
                                 style="width: min(18.75rem,100%)" alt="">
                        </td>
                    </tr>
                    <tr>
                        <th>Header Logo</th>
                        <td>
                            <img {{$data['record']->header_logo ? '' : 'style="display: none;"'}}
                                 src="{{asset('assets/images/setting/' . $data['record']->header_logo)}}"
                                 id="logo_file_preview" style="width: min(18.75rem,100%)" alt="">
                        </td>
                    </tr>
                    <tr>
                        <th>Footer Logo</th>
                        <td>
                            <img {{$data['record']->footer_logo ? '' : 'style="display: none;"'}}
                                 src="{{asset('assets/images/setting/' . $data['record']->footer_logo)}}"
                                 id="logo_file_preview" style="width: min(18.75rem,100%)" alt="">
                        </td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $data['record']->phone}} </td>
                    </tr>
                    <tr>
                        <th>Phone Optional</th>
                        <td>{{ $data['record']->phone_optional}} </td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $data['record']->email}} </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $data['record']->address}} </td>
                    </tr>
                    <tr>
                        <th>Facebook Link</th>
                        <td>
                            <a href="{{ $data['record']->facebook_link}}"
                               target="_blank">{{$data['record']->facebook_link}}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Twitter Link</th>
                        <td>
                            <a href="{{ $data['record']->twitter_link}}"
                               target="_blank">{{$data['record']->twitter_link}}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Instagram Link</th>
                        <td>
                            <a href="{{ $data['record']->instagram_link}}"
                               target="_blank">{{$data['record']->instagram_link}}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Youtube Link</th>
                        <td>
                            <a href="{{ $data['record']->youtube_link}}"
                               target="_blank">{{$data['record']->youtube_link }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Google Map Link</th>
                        <td>{{ $data['record']->google_map_link}} </td>
                    </tr>
                    <tr>
                        <th>About Us</th>
                        <td>{{ $data['record']->about_us}} </td>
                    </tr>
                    <tr>
                        <th>Opening Hours</th>
                        <td>{{ $data['record']->opening_hours}} </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>@include('components.display_status_message', ['status' => $data['record']->status])</td>
                    </tr>
                    <tr>
                        <th>Created By</th>
                        <td>{{$data['record']->createdBy->name}}</td>
                    </tr>
                    <tr>
                        <th>Updated By</th>
                        <td>
                            @if($data['record']->updated_by)
                                {{$data['record']->updatedBy->name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{$data['record']->created_at}}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{$data['record']->updated_at}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

@endsection
