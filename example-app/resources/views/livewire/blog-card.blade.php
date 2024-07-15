<div>
    <div class="row justify-content-between m-4">
        @foreach ($blogs as $blog)
            {{-- increase card width --}}
            <div class="col-md-20 mb-4">
                <div class="card">
                    <!-- Blog Image -->
                    <img src="{{ asset($blog->image) }}" class="card-img-top" alt="Blog Image">
                    <!-- Blog Content -->
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ $blog->content }}</p>
                        <div class="row justify-content-between align-items-center m-4">
                            <div class="col-auto">
                                <a href="{{ url('api/home/blog/'. $blog->id) }}" onclick="fetchWithToken(this.href, event)">
                                    <button type="button" class="btn btn-success">Read</button>
                                </a>
                            </div>

                            <div class="col-auto">
                                {{-- // Added col-auto to ensure the container takes only as much width as necessary -->
                               @if ($userId === $blog->user_id && $hasToken)
                                    <div class="row">
                                        <div class="col-auto">
                                            <a href="{{ route('blog.delete', ['id' => $blog->id]) }}"
                                                onclick="event.preventDefault(); document.getElementById('delete-blog-{{ $blog->id }}').submit();">
                                                <i class="bi bi-trash"
                                                    style="font-size: 1.5rem; color: rgba(157, 4, 4, 0.879);"></i>
                                            </a>
                                      delete
                                            <form id="delete-blog-{{ $blog->id }}"
                                                action="{{ route('blog.delete', ['id' => $blog->id]) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form> -
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ url('api/home/edit-blog/'. $blog->id) }}"> <i
                                                    class="bi bi-pencil-square"
                                                    style="font-size: 1.5rem; color: rgb(0, 0, 0);"></i></a>
                                        </div>
                                    </div>
                                @endif  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>