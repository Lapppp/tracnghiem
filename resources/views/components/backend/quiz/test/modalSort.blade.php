<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <form method="post" id="sortQuestions">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Sắp xếp câu hỏi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="showContenQuestion" style="overflow-y: auto;overflow-x: hidden;height: 500px"></div>
                <div class="modal-footer">
                    <input type="hidden" id="test_id" value="0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="updateSortQuestion">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>
