<div class="container-identity-signData">
    <div>
        <label for="signData_data" class="input-label-signData">Data</label>
        <input type="text" id="signData_data" class="input-signData" placeholder="data to be singed" required>
    </div>
    <div>
        <label for="signData_signature" class="input-label-signData">Signature</label>
        <input type="text" id="signData_signature" class="input-signData" disabled>
    </div>
    <button class="btn-identity-signData" id="signData" onclick="signData()">
        Sign data
    </button>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

        function signData() {
            let rawdata = document.getElementById('signData_data').value;
            window.IAMX.sign(rawdata);
        }

        window.addEventListener("message", function (event) {
            if (event.data.type === "FROM_IAMX") {
                console.log(event.data.msg);
                if (event.data.msg === "signData") {
                    document.getElementById('signData_signature').value = event.data.data['signature']
                }
            }
        });

    </script>
</div>
