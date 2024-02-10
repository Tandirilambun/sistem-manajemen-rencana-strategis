{{-- @dump($array_step) --}}
<div class="wrapper-step">
    <div class="header-step">
        <ul class="m-0">
            <li class="sequential-form-1">
                <div>
                    <p>1</p>
                </div>
            </li>
            <li class="sequential-form-2">
                <div>
                    <p>2</p>
                </div>
            </li>
            <li class="sequential-form-3">
                <div>
                    <p>3</p>
                </div>
            </li>
            <li class="sequential-form-4">
                <div>
                    <p>4</p>
                </div>
            </li>
            <li class="sequential-form-5">
                <div>
                    <p>5</p>
                </div>
            </li>
            <li class="sequential-form-6">
                <div>
                    <p>6</p>
                </div>
            </li>
        </ul>
    </div>
</div>
<script>
    let array = <?php echo json_encode($array_step); ?>;

    let className1 = document.querySelector(".sequential-form-1");
    let className2 = document.querySelector(".sequential-form-2");
    let className3 = document.querySelector(".sequential-form-3");
    let className4 = document.querySelector(".sequential-form-4");
    let className5 = document.querySelector(".sequential-form-5");
    let className6 = document.querySelector(".sequential-form-6");
    // console.log(array);
    if (array[0] !== 'step_1') {
        className1.classList.add("active");
        if (array[0] !== 'step_2') {
            className2.classList.add("active");
            if (array[0] !== 'step_3') {
                className3.classList.add("active");
                if (array[0] !== 'step_4') {
                    className4.classList.add("active");
                    if (array[0] !== 'step_5') {
                        className5.classList.add("active");
                        if (array[0] !== 'step_6') {
                            className6.classList.add("active");
                        }
                    }
                }
            }
        }
    }
</script>
