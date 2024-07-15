<div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
       Create Blog
      </button>
    
     
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Blog</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit="create" id="blogForm"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputTitle" class="form-label" @required(true)>Title</label>
                            <input wire:model="title"  type="text" class="form-control" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputContent" class="form-label" @required(true)>Content</label>
                            <input wire:model="content"  type="text" class="form-control" name="content">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputImage" class="form-label">Choose Image</label>
                            <input wire:model="imagePath"  type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveChangesButton">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
