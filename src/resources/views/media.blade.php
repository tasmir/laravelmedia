@auth
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link
        rel="stylesheet"
        href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
        type="text/css"
    />

    <script>
        var data = [];
        var selectedItem = null;
        const LaravelMedia = class {
            constructor(selector) {
                document.querySelectorAll(`${selector}`).forEach(this.myFunction);
            }

            myFunction(item) {
                item.addEventListener("click", function (e) {
                    e.preventDefault();

                    const div1 = document.createElement('div');
                    div1.classList.add("modal-of-media");
                    document.body.appendChild(div1);
                    div1.innerHTML = `<style>
        :root {
            --mp: 1rem;
            --m-bg: #ffffff;
            --m-radious: 8px;
        }

        .media-modal {
            /*padding: 1rem;*/
            position: absolute;
            z-index: 1040;
            left: 1.5rem;
            top: 1.5rem;
            bottom: 1.5rem;
            right: 1.5rem;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgb(0 0 0 / 70%);
            height: 42rem;
        }

        .m-modal-header {
            padding: var(--mp);
            background-color: var(--m-bg);
            border-top-left-radius: var(--m-radious);
            border-top-right-radius: var(--m-radious);
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
        }

        .m-modal-header .btn-close {
            margin: 0;
            padding: 0;
            border: 1px solid transparent;
            background: 0 0;
            color: #646970;
            z-index: 1000;
            cursor: pointer;
            outline: 0;
            font-size: 18px;
            transition: color .1s ease-in-out, background .1s ease-in-out;
            font-weight: 700;
        }

        .m-modal-body {
            position: relative;
            width: 100%;
            height: 79%;
            overflow: hidden;
        }

        .m-modal-medias {
            display: flex;
            flex-wrap: wrap;
        }

        .m-media-box {
            position: absolute;
            top: 0;
            left: 0;
            right: 267px;
            bottom: 0;
            overflow: auto;
            outline: 0;
        }

        .m-thumbnail-details {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 267px;
            padding: 0 16px;
            z-index: 75;
            background: #f6f7f7;
            border-left: 1px solid #dcdcde;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
        }

        .m-thumbnail-details img {
            max-width: 100%;
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            width: inherit;
            object-fit: cover;
            margin-top: 16px;
        }

        .m-thumbnail-details p {
            margin-bottom: 0;
            font-size: 12px;
        }

        .m-thumbnail-details label {
            margin: 0;
            padding: 0;
            font-size: 12px;
            font-weight: 600;
        }

        .dropzone .dz-preview {
            margin: 0;
        }
        .m-modal-medias .m-thumbnail, .dz-image-preview .dz-image {
            padding: .75em;
            max-width: 100%;
            width: 120px;
            height: 120px;
            cursor: pointer;
        }

        .m-modal-medias .m-thumbnail img, .dz-image-preview .dz-image img {
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            width: inherit;
            object-fit: cover;
            height: inherit;
            max-width: 100%;
            max-height: 100%;
        }

        .m-selected {
            box-shadow: inset 0 0 0 3px #fff, inset 0 0 0 7px #2271b1;
        }

        .m-selected img {
            padding: 0 !important;
        }

        .m-modal-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: var(--mp);
            background-color: var(--m-bg);
            border-bottom-left-radius: var(--m-radious);
            border-bottom-right-radius: var(--m-radious);
            border-top: 1px solid #ddd;
            display: flex;
            justify-content: flex-end;
        }

        .m-modal-footer button {
            background: #2271b1;
            border-color: #2271b1;
            color: #fff;
            text-decoration: none;
            text-shadow: none;
            padding: 8px 12px;
            cursor: pointer;
            border-width: 1px;
            border-style: solid;
            -webkit-appearance: none;
            border-radius: 3px;
            white-space: nowrap;
            box-sizing: border-box;
        }


        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            height: 100%;
            /*background: rgba(0, 0, 0, 0.5);*/
            background: #000;
            backdrop-filter: blur(3px);
            opacity: .7;
            z-index: 1;
        }

        .hidden {
            display: none;
        }
        .m-option-buttons {
            background-color: #ddd;
        }
        .m-option-buttons button {
            background: #ddd;
            border: none;
            padding: 6px 15px;
        }
        .m-option-buttons button.m-button-selected {
            background: #fff;
        }


    </style>`;
                    selectedItem = this;
                    fetchMedia(div1);
                    // this.setAttribute('type', 'text');

                })
            }
        }
        new LaravelMedia('input[type=file]');


    </script>
    <script>
        async function fetchMedia(div1) {
            let base_url = window.location.origin;
            let url = base_url + "/library/fetch-media"
            const response = await fetch(url);
            data = await response.json();
            let mediaModal = document.createElement('div');
            mediaModal.classList.add("media-modal");

            let mModelHeader = document.createElement('div');
            mModelHeader.classList.add("m-modal-header");
            let mHTitle = document.createElement('div');
            mHTitle.classList.add("m-h-title");
            let mHh2 = document.createElement('h2');
            mHh2.innerHTML = "Select or Upload Media";
            mHh2.style.margin = "0";

            let mHButtons = document.createElement('div');
            mHButtons.classList.add("m-h-buttons");
            let btnClose = document.createElement('button');
            btnClose.classList.add("btn-close");
            btnClose.innerHTML = "x";

            let mModalBody = document.createElement('div');
            mModalBody.classList.add("m-modal-body");

            let mMediaBox = document.createElement('div');
            mMediaBox.classList.add("m-media-box");

            let mOptionButtons = document.createElement('div');
            mOptionButtons.classList.add("m-option-buttons");
            let mOptionButtons1 = document.createElement('button');
            mOptionButtons1.innerHTML = "Upload";
            mOptionButtons1.dataset.content = "dropzone";

            let mOptionButtons2 = document.createElement('button');
            mOptionButtons2.classList.add("m-button-selected");
            mOptionButtons2.innerHTML = "Media";
            mOptionButtons2.dataset.content = "m-modal-medias";
            mOptionButtons.appendChild(mOptionButtons1);
            mOptionButtons.appendChild(mOptionButtons2);

            let mModalMediasForm = document.createElement('form');
            mModalMediasForm.classList.add("dropzone");
            mModalMediasForm.classList.add("hidden");
            mModalMediasForm.setAttribute('id', "myAwesomeDropzone");
            mModalMediasForm.setAttribute('action', base_url + '/library/media-upload');
            mModalMediasForm.setAttribute('method', "post");
            mModalMediasForm.style.height = "90%";
            mModalMediasForm.style.border = "0";

            mModalMediasForm.innerHTML = `{{csrf_field()}}`;
            let inputFile = document.createElement('input');
            inputFile.setAttribute('type', 'file');
            inputFile.setAttribute('name', 'file');
            inputFile.setAttribute('hidden', 'hidden');
            mModalMediasForm.appendChild(inputFile);

            let mModalMedias = document.createElement('div');
            mModalMedias.classList.add("m-modal-medias");
            mModalMedias.style.height = "90%";
            mModalMedias.style.border = "0";

            // let csrf =document.createElement('input')
            // csrf.setAttribute("value","{{--csrf_field()--}}")
            // csrf.setAttribute('type','hidden');
            // csrf.setAttribute("name","_token");
            // mModalMedias.appendChild(csrf);


            for (let i = 0; i < data.length; i++) {
                let mThumbnail = document.createElement('div');
                mThumbnail.classList.add("m-thumbnail");
                mThumbnail.dataset.id = data[i]['id'];
                mThumbnail.dataset.index = i;
                let mThumbnailImage = document.createElement('img');
                mThumbnailImage.src = data[i]['image'];

                mThumbnail.appendChild(mThumbnailImage);
                mModalMedias.appendChild(mThumbnail);
            }

            let mThumbnailDetails = document.createElement('div');
            mThumbnailDetails.classList.add("m-thumbnail-details");


            let mModalFooter = document.createElement('div');
            mModalFooter.classList.add("m-modal-footer");
            let mSelectButton = document.createElement('button');
            mSelectButton.classList.add("m-select-button");
            mSelectButton.innerHTML = "Select";

            let overlay = document.createElement('div');
            overlay.classList.add("overlay");

            mHTitle.appendChild(mHh2);
            mHButtons.appendChild(btnClose);
            mModelHeader.appendChild(mHTitle);
            mModelHeader.appendChild(mHButtons);

            mMediaBox.appendChild(mOptionButtons);
            mMediaBox.appendChild(mModalMediasForm);
            mMediaBox.appendChild(mModalMedias);
            mModalBody.appendChild(mMediaBox);
            mModalBody.appendChild(mThumbnailDetails);

            mModalFooter.appendChild(mSelectButton);
            mediaModal.appendChild(mModelHeader);
            mediaModal.appendChild(mModalBody);
            mediaModal.appendChild(mModalFooter);

            div1.appendChild(mediaModal)
            div1.appendChild(overlay)


            /**/
            var dropzone = new Dropzone('#myAwesomeDropzone', {

                thumbnailWidth: 200,

                maxFilesize: 10,

                acceptedFiles: ".jpeg,.jpg,.png,.gif"

            });
            /**/

            const modal = document.querySelector(".media-modal");
            // const overlay = document.querySelector(".overlay");
            // const openModalBtn = document.querySelector(".btn-open");
            const closeModalBtn = document.querySelector(".btn-close");

            // close modal function
            // const closeModal = function () {
            //     modal.classList.add("hidden");
            //     overlay.classList.add("hidden");
            //     div1.remove();
            //     // console.log(event.parentElement.remove())
            //     // modal-of-media
            // };

            // close the modal when the close button and overlay is clicked
            closeModalBtn.addEventListener("click", closeModal);
            overlay.addEventListener("click", closeModal);

            // close modal when the Esc key is pressed
            document.addEventListener("keydown", function (e) {
                if (e.key === "Escape" && !modal.classList.contains("hidden")) {
                    closeModal();
                }
            });

            // open modal function
            const openModal = function () {
                modal.classList.remove("hidden");
                overlay.classList.remove("hidden");
            };

            // if (document.readyState === "complete") {
            //     // Fully loaded!
            //     console.log(document.querySelectorAll(`.m-modal-medias .m-thumbnail`).length);
            // }

            onClickMedia();
        }

        const closeModal = function () {

            document.querySelector(".media-modal").classList.add("hidden");
            document.querySelector(".overlay").classList.add("hidden");
            document.querySelector(".modal-of-media").remove();
        };

        function onClickMedia() {
            document.querySelectorAll(`.m-modal-medias .m-thumbnail`).forEach(myFunction);
            const selectButton = document.querySelector(".m-select-button");
            selectButton.addEventListener("click", returnValue);
            document.querySelectorAll(".m-option-buttons button").forEach(eachButtonOption);
        }

        function myFunction(item) {
            item.addEventListener("click", function (e) {
                e.preventDefault();

                let mThumbnailDetails = document.querySelector(`.m-thumbnail-details`);
                mThumbnailDetails.innerHTML = '';
                if (this.classList.contains("m-selected")) {
                    this.classList.remove("m-selected");
                } else {
                    document.querySelectorAll(`.m-modal-medias .m-thumbnail.m-selected`).forEach(removeSelection)
                    this.classList.add("m-selected");
                    let pos = this.dataset.index;
                    let html = '';
                    html = `<img src="${data[pos]['image']}">
            <label>Name</label>
            <p>${data[pos]['name']}</p>
            <label>Last Updated</label>
            <p>${data[pos]['updated']}</p>
            <label>Size</label>
            <p>${data[pos]['size']}</p>
            <label>Dimension</label>
            <p>${data[pos]['dimension']}</p>
            <label>Original Path</label>
            <p>${data[pos]['original_path']}</p>
            <label>Public Path</label>
            <p>${data[pos]['public_path']}</p>
            <p>
            </p>`;
                    mThumbnailDetails.innerHTML = html;
                }

            });
        }

        function removeSelection(item) {
            item.classList.remove("m-selected");
        }

        // const selectButton = document.querySelector(".m-select-button");
        // selectButton.addEventListener("click", returnValue);

        function returnValue() {
            let selected = document.querySelectorAll(".m-thumbnail.m-selected");
            if (selected.length == 1) {
                let po = selected[0].dataset.index;
                selectedItem.dataset.src = data[po]["image"];
                selectedItem.dataset.name = data[po]["original_path"];
                selectedItem.setAttribute('type', 'text');
                selectedItem.value = selected[0].dataset.id;
                selectedItem.dispatchEvent(new Event('change'));
            }
            closeModal();
        }

        function copyText() {
            let copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");

            let tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copied: " + copyText.value;
        }

        function outFunc() {
            let tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copy to clipboard";
        }

        // document.querySelectorAll(".m-option-buttons button").forEach(eachButtonOption);

        function eachButtonOption(item) {
            item.addEventListener("click", buttonSelection);
        }

        function buttonSelection(item) {
            document.querySelectorAll(`.m-option-buttons button.m-button-selected`).forEach(removeButtonSelection);
            document.querySelectorAll(`.dropzone div.dz-preview`).forEach(removePewviewImages);
            this.classList.add('m-button-selected');
            document.querySelector(`.${this.dataset.content}`).classList.remove('hidden');
            if (this.dataset.content === "m-modal-medias" && document.querySelector(`.dropzone.dz-clickable`).classList.contains('dz-started')) {
                document.querySelector(`.dropzone.dz-clickable.dz-started`).classList.remove('dz-started');
            }
        }

        function removeButtonSelection(item) {
            item.classList.remove("m-button-selected");
            document.querySelector(`.${item.dataset.content}`).classList.add('hidden');
        }

        function removePewviewImages(item) {
            item.remove();
        }

        // }


    </script>

    <script>
        Dropzone.options.myAwesomeDropzone = {
            success: function (file, response) {
                //Here you can get your response.
                let data1 = response.data;
                let mThumbnail = document.createElement('div');
                mThumbnail.classList.add("m-thumbnail");
                mThumbnail.dataset.id = data1['id'];
                mThumbnail.dataset.index = document.querySelectorAll('.m-modal-medias .m-thumbnail').length;
                let mThumbnailImage = document.createElement('img');
                mThumbnailImage.src = data1['image'];

                mThumbnail.appendChild(mThumbnailImage);
                // mModalMedias.appendChild(mThumbnail);
                let fst_item = document.querySelector('.m-modal-medias').firstChild;
                document.querySelector('.m-modal-medias').insertBefore(mThumbnail, fst_item);
                data.push(data1);
                onClickMedia();
            }
        }
    </script>
    <style>
        .m-modal-medias, .m-thumbnail,
        .m-modal-medias::after, .m-thumbnail::after,
        .m-modal-medias::before, .m-thumbnail ::before {
            box-sizing: unset;
        }
    </style>
@endauth
