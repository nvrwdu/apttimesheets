<div class="main-timesheet-container">
    <form class="pure-form pure-form-stacked" action="../../action/ActionNewTimesheet.php" method="post">

        <?php
        $formValues = $_GET;
        //$_GET['name'] = '';

        //print_r($_SESSION['singleTimesheet'][0]['Contract']);
        $singleTimesheet = $_SESSION['singleTimesheet'];
        print_r($singleTimesheet);

        ?>

        <legend class="">New timesheet</legend>
        <br>
        <h5>Status : <?php echo $singleTimesheet[0]['Status']; ?></h5>
        <fieldset>
            <div class="date-timefrom-timeto-container">
                <div class="date">
                    <label for="date">Date</label>
                    <input type="date" name="datetime[0]['date']" placeholder="Date" value="<? echo $singleTimesheet[0]['Date']; ?>" />
                </div>
                <div class="time-from">
                    <label for="time-from">Time From</label>
                    <input type="time" name="datetime[0]['timefrom']" placeholder="Time" value="<? echo $singleTimesheet[0]['TimeFrom']; ?>" />
                </div>
                <div class="time-to">
                    <label for="time-from">Time To</label>
                    <input type="time" name="datetime[0]['timeto']" placeholder="Time" value="<? echo $singleTimesheet[0]['TimeTo']; ?>" />
                </div>
            </div>

            <label for="contract">Contract</label>
                <?
                // Keep select contract value equal to timesheet contract value
                    $xml =
                        "<select name='contract'>
                            <option>Telent</option>
                            <option>KNN</option>
                            <option>Virgin Media</option>
                        </select>";

                    $timesheetContract = $singleTimesheet[0]['Contract'];

                    $contractOptions = simplexml_load_string($xml);
                    $optionValues = $contractOptions->option;

                    for ($i=0 ; $i < count($optionValues) ; $i++) {
                        if ($optionValues[$i] == $timesheetContract) {
                            echo 'found at index: ' . $i;
                            $contractOptions->option[$i]->addAttribute('selected', '');
                        }
                    }

                    echo $contractOptions->asXML();
                ?>



            <label for="jobnumber">Job Number</label>
            <input type="text" name="jobnumber" placeholder="Job Number" value="<? echo $singleTimesheet[0]['JobNumber']; ?>" />

            <label for="estimate">Estimate</label>
            <input type="text" name="estimate" placeholder="Estimate" value="<? echo $singleTimesheet[0]['Estimate']; ?>" />

            <label for="exchange">Exchange</label>
            <input type="text" name="exchange" placeholder="Exchange" value="<? echo $singleTimesheet[0]['Exchange']; ?>" />

            <br><br><br>


            <b>Planned work</b><br><br>

            Synthetic <input type="text" name="plannedsynthetic[1]['plannedsynthetic']"> Quantity <input type="text" name="plannedsynthetic[1]['quantity']"><br>
            <button type="button" class="pure-button" id="btn-add-new-planned-synthetic">Add</button>

            <br><br><br><br>


            <b>DfE's / Unplanned work</b><br><br>

            Synthetic <input type="text" name="unplannedsynthetic[1]['unplannedsynthetic']"> Quantity <input type="text" name="unplannedsynthetic[1]['quantity']">
            <textarea id="textarea-unplanned-work-comments-box" name="unplannedsynthetic[1]['comments']" placeholder="Comments"></textarea>
            <br>
            <button type="button" class="pure-button" id="btn-add-new-planned-synthetic">Add</button>

            <br><br><br><br>
            <textarea id="textarea-timesheet-comments-box" name="timesheetcomments" placeholder="Timesheet comments"></textarea>
            <br>


            <br><br>

            <button type="submit" class="pure-button pure-button-primary">Submit Timesheet</button>
        </fieldset>
    </form>
</div>