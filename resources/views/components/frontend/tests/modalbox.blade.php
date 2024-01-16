<div class="modal_box">
    <div class="modal-content_box">
        <span class="close_box">&times;</span>
        <div class="" id="showContentBaiGia"></div>
    </div>
</div>
<style>
    .modal_box {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, .4);
    }

    .modal-content_box {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        position: relative;
        border-radius: 3px;
    }

    .close_box {
        color: #aaaaaa;
        right: 10px;
        top: 8px;
        font-size: 28px;
        font-weight: bold;
        position: absolute;

    }

    .close_box:hover,
    .close_box:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

</style>
