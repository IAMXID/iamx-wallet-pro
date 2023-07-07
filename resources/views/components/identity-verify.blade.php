<div class="container-identity-verifyData">
    <div>
        <label for="verifyData_data" class="input-label-verifyData">Data</label>
        <input type="text" id="verifyData_data" class="input-verifyData" placeholder="data to be verified" required>
    </div>
    <div>
        <label for="verifyData_signature" class="input-label-verifyData">Signature</label>
        <input type="text" id="verifyData_signature" class="input-verifyData" placeholder="signature" required>
    </div>
    <div>
        <label for="verifyData_verified" class="input-label-verifyData">Verified</label>
        <input type="text" id="verifyData_verified" class="input-verifyData" disabled>
    </div>
    <button class="btn-identity-verifyData" id="verifyData" onclick="verifyData()">
        Verify data
    </button>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

        function verifyData() {
            let rawdata = document.getElementById('verifyData_data').value;
            let signature = document.getElementById('verifyData_signature').value;
            window.IAMX.verify(rawdata, signature);
        }

        window.addEventListener("message", function (event) {
                if (event.data.type === "FROM_IAMX") {
                    console.log(event.data.msg);
                    if (event.data.msg === "verifyData") {
                        document.getElementById('verifyData_verified').value = event.data.data['verified']
                    }
                }
            }
        );

    </script>
</div>
