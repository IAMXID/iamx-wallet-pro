<div class="container-identity-decryptData">
    <div>
        <label for="decrypt_encryptedData" class="input-label-decryptData">Encrypted data</label>
        <input type="text" id="decrypt_encryptedData" class="input-decryptData" placeholder="data to be decrypted" required>
    </div>
    <div>
        <label for="decrypt_decryptedData" class="label">Decrypted data</label>
        <input type="text" id="decrypt_decryptedData" class="input-decryptData" disabled>
    </div>
    <button class="btn-identity-decryptData" id="decryptData" onclick="decryptData()">
        Decrypt data
    </button>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

        function decryptData() {
            let rawdata = document.getElementById('decrypt_encryptedData').value;
            window.IAMX.decrypt(rawdata);
        }

        window.addEventListener("message", function (event) {
                if (event.data.type === "FROM_IAMX") {
                    console.log(event.data.msg);
                    if (event.data.msg === "decryptData") {
                        document.getElementById('decrypt_decryptedData').value = event.data.data['decrypted']
                    }
                }
            }
        );

    </script>
</div>
