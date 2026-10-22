<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no">
        <title>Memory Calculator</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/scripts/styles.css">
    </head>
    <body>

        <div class="memory-control-container"> 
            <div class="operation-counter" data-memory="operation-counter">
                Press = to save the equation
            </div> 
            <div class="view-button" data-memory="view-button">
                No Items
            </div> 
        </div> 
        <div class="display">
            <div class="equation-container">
                <div class="equation-line" data-display="equation"></div>
                <div class="blinker">_</div>
            </div>
            <div class="answer-line" data-display="answer"></div>
        </div> 
        <div class="buttons-container">
            <div class="number-container">
                <div class="" data-button="number">1</div>
                <div class="" data-button="number">2</div>
                <div class="" data-button="number">3</div>
                <div class="" data-button="number">4</div>
                <div class="" data-button="number">5</div>
                <div class="" data-button="number">6</div>
                <div class="" data-button="number">7</div>
                <div class="" data-button="number">8</div>
                <div class="" data-button="number">9</div>
                <div class="" data-button="decimal">.</div>
                <div class="" data-button="number">0</div>
                <div class="" data-button="answer">Ans</div>
            </div>
            <div class="operations-container">
                <div class="blue" data-button="cancel">C</div>
                <div class="blue" data-button="clear">CE</div>
                <div class="" data-button="operation">*</div>
                <div class="" data-button="operation">/</div>
                <div class="" data-button="operation">+</div>
                <div class="" data-button="operation">-</div>
                <div class="equals" data-button="equals" style="width: 100%;">=</div>
            </div>
        </div>

        <div class="cover" data-cover="parent">
            <div class="title">
                Memory
            </div> 
            <div class="list-container">
                <ul data-cover="list">
                </ul>
            </div>

            <div class="controls">
                <div class="clear-button" data-cover="clear-button">
                    Clear Memory
                </div>
                <div class="close-button" data-cover="close-button">
                    Close
                </div>
            </div>
        </div>

        <script src="<?php echo base_url(); ?>assets/scripts/operations.js" charset="utf-8"></script>
        <script src="<?php echo base_url(); ?>assets/scripts/display.js" charset="utf-8"></script>
        <script src="<?php echo base_url(); ?>assets/scripts/buttons.js" charset="utf-8"></script>
        <script src="<?php echo base_url(); ?>assets/scripts/localStorage.js" charset="utf-8"></script>
        <script src="<?php echo base_url(); ?>assets/scripts/tophandler.js" charset="utf-8"></script>
        <script src="<?php echo base_url(); ?>assets/scripts/coverhandler.js" charset="utf-8"></script>
        <script src="<?php echo base_url(); ?>assets/scripts/main.js" charset="utf-8"></script>
    </body>
</html>
