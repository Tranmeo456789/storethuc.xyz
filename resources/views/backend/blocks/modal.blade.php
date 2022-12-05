
<div class="modal fade" id="modalDelete" role="dialog" style="margin-top:90px">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-title">Xóa {{ $pageTitle ?? ''}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa {{ $pageTitle ?? ''}}: <span></span></p>
                <input type="hidden" id="delete_token"/>
                <input type="hidden" id="delete_id"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id='btn-confim-delete' >
                    Xóa
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
            </div>
        </div>
    </div>
</div>