<div class="container-identity-encryptData">
    <div>
        <label for="encrypt_decryptedData" class="input-label-encryptData">Data</label>
        <input type="text" id="encrypt_decryptedData" class="input-encryptData" placeholder="data to be encrypted" required>
    </div>
    <div>
        <label for="encrypt_encryptedData" class="input-label-encryptData">Encrypted data</label>
        <input type="text" id="encrypt_encryptedData" class="input-encryptData" disabled>
    </div>
    <button class="btn-identity-encryptData" id="encryptData" onclick="encryptData()">
        Encrypt data
    </button>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

        function encryptData() {
            let rawdata = document.getElementById('encrypt_decryptedData').value;
            window.IAMX.encrypt(rawdata);
        }

        window.addEventListener("message", function (event) {
                if (event.data.type === "FROM_IAMX") {
                    console.log(event.data.msg);
                    if (event.data.msg === "encryptData") {
                        document.getElementById('encrypt_encryptedData').value = event.data.data['encrypted']
                    }
                }
            }
        );

    </script>
</div>
