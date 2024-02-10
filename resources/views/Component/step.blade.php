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
            <li class="sequential-form-7">
                <div>
                    <p>7</p>
                </div>
            </li>
            <li class="sequential-form-8">
                <div>
                    <p>8</p>
                </div>
            </li>
            <li class="sequential-form-9">
                <div>
                    <p>9</p>
                </div>
            </li>
            <li class="sequential-form-10">
                <div>
                    <p>10</p>
                </div>
            </li>
            <li class="sequential-form-11">
                <div>
                    <p>11</p>
                </div>
            </li>
            <li class="sequential-form-12">
                <div>
                    <p>12</p>
                </div>
            </li>
            <li class="sequential-form-13">
                <div>
                    <p>13</p>
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
    let className7 = document.querySelector(".sequential-form-7");
    let className8 = document.querySelector(".sequential-form-8");
    let className9 = document.querySelector(".sequential-form-9");
    let className10 = document.querySelector(".sequential-form-10");
    let className11 = document.querySelector(".sequential-form-11");
    let className12 = document.querySelector(".sequential-form-12");
    let className13 = document.querySelector(".sequential-form-13");
    // console.log(array);
    if (array[0] !== 'step-1') {
        className1.classList.add("active");
        if (array[0] !== 'step-2') {
            className2.classList.add("active");
            if (array[0] !== 'step-3') {
                className3.classList.add("active");
                if (array[0] !== 'step-4') {
                    className4.classList.add("active");
                    if (array[0] !== 'step-5') {
                        className5.classList.add("active");
                        if (array[0] !== 'step-6') {
                            className6.classList.add("active");
                            if (array[0] !== 'step-7') {
                                className7.classList.add("active");
                                if (array[0] !== 'step-8') {
                                    className8.classList.add("active");
                                    if (array[0] !== 'step-9') {
                                        className9.classList.add("active");
                                        if (array[0] !== 'step-10') {
                                            className10.classList.add("active");
                                            if (array[0] !== 'step-11') {
                                                className11.classList.add("active");
                                                if (array[0] !== 'step-12') {
                                                    className12.classList.add("active");
                                                    if (array[0] !== 'step-13') {
                                                        className13.classList.add("active");
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
</script>
