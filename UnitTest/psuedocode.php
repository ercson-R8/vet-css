
<?php


per classID (0-7){ // persubject class
    per distBlock(1x) w/ 2-3periods{
        sameDay = false;
        while !(sameDay){
            find random (0-9) strating period n
            check if random period n and n+1 is on the same day
                sameDay= true;
        }
        per period{ start random n period up n+1 period
            booked = false;
            while !(booked){
                check if slot is empty{
                    reserve the slot [$random n][]
                    booked = true;
                }else{ // if there are classes already booked in this slot
                    get all the others rooms,
                    find all matching other rooms
                    fitness += all matching rooms
                    reserve the slot
                    booked = true

                }               

            }

        }        
    }
}
