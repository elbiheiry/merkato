<div class="modal fade" id="delete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
            <div class="modal_title">هل أنت متاكد ؟</div>
            <form class="text-center" id="delete-form" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="link" style="background-color:red">حذف</button>
            </form>
        </div>
    </div>
</div>
