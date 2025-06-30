<html>

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link rel="stylesheet" as="style" onload="this.rel='stylesheet'"
        href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Space+Grotesk%3Awght%40400%3B500%3B700" />

    <title>Sim DANA</title>
    <link rel="icon" type="image/png" href="https://technode.global/wp-content/uploads/2024/03/Screenshot-2024-03-08-103424-uai-737x415.png" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>

<body>
    <div class="relative flex size-full min-h-screen flex-col bg-[#111814] dark group/design-root overflow-x-hidden"
        style='font-family: "Space Grotesk", "Noto Sans", sans-serif;'>
        <div class="layout-container flex h-full grow flex-col">
            <div class="gap-1 px-6 flex flex-1 justify-center py-5">
                <div class="layout-content-container flex flex-col w-80">
                    <div class="flex h-full min-h-[700px] flex-col justify-between bg-[#111814] p-4">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col">
                                <h1 class="text-white text-base font-medium leading-normal">API Tester</h1>
                                <p class="text-[#9db8a9] text-sm font-normal leading-normal">Version 1.0</p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-3 px-3 py-2 rounded-full bg-[#29382f]">
                                    <div class="text-white" data-icon="Globe" data-size="24px" data-weight="regular">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                            fill="currentColor" viewBox="0 0 256 256">
                                            <path
                                                d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24ZM101.63,168h52.74C149,186.34,140,202.87,128,215.89,116,202.87,107,186.34,101.63,168ZM98,152a145.72,145.72,0,0,1,0-48h60a145.72,145.72,0,0,1,0,48ZM40,128a87.61,87.61,0,0,1,3.33-24H81.79a161.79,161.79,0,0,0,0,48H43.33A87.61,87.61,0,0,1,40,128ZM154.37,88H101.63C107,69.66,116,53.13,128,40.11,140,53.13,149,69.66,154.37,88Zm19.84,16h38.46a88.15,88.15,0,0,1,0,48H174.21a161.79,161.79,0,0,0,0-48Zm32.16-16H170.94a142.39,142.39,0,0,0-20.26-45A88.37,88.37,0,0,1,206.37,88ZM105.32,43A142.39,142.39,0,0,0,85.06,88H49.63A88.37,88.37,0,0,1,105.32,43ZM49.63,168H85.06a142.39,142.39,0,0,0,20.26,45A88.37,88.37,0,0,1,49.63,168Zm101.05,45a142.39,142.39,0,0,0,20.26-45h35.43A88.37,88.37,0,0,1,150.68,213Z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-white text-sm font-medium leading-normal">Simulator</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
                    <div class="px-4 py-3">
                        <label class="flex flex-col min-w-40 w-full">
                            <div class="flex w-full h-12 items-stretch rounded-xl overflow-hidden">
                                <!-- Search Icon -->


                                <!-- Input Field -->
                                <input id="request-url" placeholder="Enter request URL"
                                    class="form-input flex-1 border-none bg-[#29382f] text-white placeholder:text-[#9db8a9] px-4 focus:outline-0 text-base h-full"
                                    value="" />

                                <!-- Send Button -->
                                <button id="send-button"
                                    class="h-full px-4 bg-[#14b758] text-[#111814] text-sm font-bold tracking-[0.015em] rounded-r-xl">
                                    <span class="truncate">Send</span>
                                </button>
                            </div>
                        </label>
                    </div>

                   <div class="flex px-4 py-3">
                        <div id="status-indicator" class="flex h-10 flex-1 items-center justify-center rounded-full bg-[#29382f] p-1 text-white text-sm font-medium tracking-wide">
                            <!-- Loading text will go here -->
                        </div>
                    </div>
                    <div class="pb-3">
                        <div class="flex border-b border-[#3c5345] px-4 gap-8">
                            <a class="flex flex-col items-center justify-center border-b-[3px] border-b-white text-white pb-[13px] pt-4"
                                href="#">
                                <p class="text-white text-sm font-bold leading-normal tracking-[0.015em]">JSON Body Request</p>
                            </a>

                        </div>
                    </div>
                    <div class="flex max-w-[1080px] flex-wrap items-end gap-4 px-4 py-3">
                        <label class="flex flex-col min-w-40 flex-1">
                            <p class="text-white text-base font-medium leading-normal pb-2"></p>
                            <textarea id="request-body" oninput="autoResize(this)"
                                placeholder="Place your request input json"
                                class="form-input w-full min-w-0 resize-none overflow-hidden rounded-xl text-white focus:outline-0 focus:ring-0 border-none bg-[#29382f] focus:border-none min-h-36 placeholder:text-[#9db8a9] p-4 text-base font-normal leading-normal"></textarea>
                        </label>
                    </div>
                    <h2 class="text-white text-[22px] font-bold leading-tight tracking-[-0.015em] px-4 pb-3 pt-5">
                        Response</h2>
                    <div class="pb-3">
                        <div class="flex border-b border-[#3c5345] px-4 gap-8">
                            <a class="flex flex-col items-center justify-center border-b-[3px] border-b-white text-white pb-[13px] pt-4"
                                href="#">
                                <p class="text-white text-sm font-bold leading-normal tracking-[0.015em]">Body Response</p>
                            </a>

                        </div>
                    </div>
                    <div class="flex max-w-[1080px] flex-wrap items-end gap-4 px-4 py-3">
                        <label class="flex flex-col min-w-40 flex-1">
                            <div id="response-body"
                                class="w-full min-w-0 rounded-xl text-white bg-[#29382f] min-h-36 p-4 text-base font-normal leading-normal whitespace-pre-wrap break-words font-mono">
                                <!-- Highlighted JSON response goes here -->
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
    }

    document.querySelectorAll("textarea").forEach(autoResize);

    function escapeHTML(str) {
        return str
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    function highlightJSON(json) {
        if (typeof json !== 'string') {
            json = JSON.stringify(json, null, 2);
        }

        json = escapeHTML(json); // Prevent HTML entities

        // Highlight keys and values
        json = json
            .replace(/(&quot;(.*?)&quot;)(?=\s*:)/g, '<span style="color:#51b9fe;">$1</span>') // keys
            .replace(/:\s?&quot;(.*?)&quot;/g, ': <span style="color:#ac915c;">&quot;$1&quot;</span>') // strings
            .replace(/:\s?(\d+)/g, ': <span style="color:#ac915c;">$1</span>') // numbers
            .replace(/:\s?(true|false|null)/g, ': <span style="color:#facc15;">$1</span>'); // bool/null

        return json;
    }

    document.getElementById("send-button").addEventListener("click", async function () {
        const fixedUrl = "/api/request";
        const userUrl = document.getElementById("request-url").value.trim();
        const userBody = document.getElementById("request-body").value.trim();
        const responseDisplay = document.getElementById("response-body");
        const statusIndicator = document.getElementById("status-indicator");

        if (!userUrl) {
            alert("Please enter the request URL.");
            return;
        }

        let parsedBody = {};
        try {
            parsedBody = userBody ? JSON.parse(userBody) : {};
        } catch (err) {
            responseDisplay.textContent = "❌ Invalid JSON body: " + err.message;
            statusIndicator.textContent = "❌ Invalid JSON body";
            statusIndicator.classList.remove("text-green-500");
            statusIndicator.classList.add("text-red-500");
            return;
        }

        const payload = {
            url: userUrl,
            body: parsedBody
        };

        statusIndicator.textContent = "Sending...";
        statusIndicator.classList.remove("text-green-500", "text-red-500");
        statusIndicator.classList.add("text-yellow-400");

        try {
            const response = await fetch(fixedUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                },
                body: JSON.stringify(payload)
            });

            const contentType = response.headers.get("Content-Type");
            let responseData;

            if (contentType && contentType.includes("application/json")) {
                responseData = await response.json();
                responseDisplay.innerHTML = highlightJSON(responseData);
            } else {
                const text = await response.text();
                responseDisplay.textContent = text;
            }

            statusIndicator.textContent = "✅ Request Successful";
            statusIndicator.classList.remove("text-yellow-400", "text-red-500");
            statusIndicator.classList.add("text-green-500");

            responseDisplay.scrollIntoView({ behavior: "smooth", block: "start" });

        } catch (error) {
            responseDisplay.textContent = "❌ Error: " + error.message;
            statusIndicator.textContent = "Request Failed";
            statusIndicator.classList.remove("text-yellow-400", "text-green-500");
            statusIndicator.classList.add("text-red-500");
        }
    });
</script>



</html>
