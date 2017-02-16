<?php

require "init-classes.php";
$timetable  = new Timetables(1, 2016, 1, "blah",0);
    print_r ($timetable); 


    $obj            = createSubjecClasses();
    $subject        = $obj[0];
    $traineeGroup   = $obj[1];
    $teacher        = $obj[2];
    $room           = $obj[3];
    $preference     = $obj[4];
    $subjectClass   = $obj[5];


/* 

    Schedule array: Array
(
    [0] => Array
        (
            [0] => 3
        )

    [1] => Array
        (
            [0] => 3
        )

    [2] => 
    [3] => Array
        (
            [0] => 4
        )

    [4] => Array
        (
            [0] => 4
        )

    [5] => Array
        (
            [0] => 0
            [1] => 2
        )

    [6] => Array
        (
            [0] => 0
            [1] => 2
            [2] => 3
        )

    [7] => Array
        (
            [0] => 3
        )

    [8] => 
    [9] => 
    [10] => Array
        (
            [0] => 1
            [1] => 5
        )

    [11] => Array
        (
            [0] => 1
            [1] => 5
        )

    [12] => Array
        (
            [0] => 1
        )

    [13] => Array
        (
            [0] => 1
        )

    [14] => 
)
Array
(
    [0] => Array
        (
            [0] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 8
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 3
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 3
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 2
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                            [1] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 0
                        )

                )

            [1] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 9
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 3
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 3
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 2
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                            [1] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 1
                        )

                )

            [2] => 
            [3] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 12
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 4
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 101
                                            [subjectCode:Subjects:private] => MATH101
                                            [subjectName:Subjects:private] => Basic Math
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Basic Math

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 301
                                            [teacherName:Teachers:private] => John
                                            [teacherDescription:Teachers:private] => Math teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 4
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 3
                        )

                )

            [4] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 13
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 4
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 101
                                            [subjectCode:Subjects:private] => MATH101
                                            [subjectName:Subjects:private] => Basic Math
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Basic Math

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 301
                                            [teacherName:Teachers:private] => John
                                            [teacherDescription:Teachers:private] => Math teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 4
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 4
                        )

                )

            [5] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 0
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 0
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 101
                                            [subjectCode:Subjects:private] => MATH101
                                            [subjectName:Subjects:private] => Basic Math
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Basic Math

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 301
                                            [teacherName:Teachers:private] => John
                                            [teacherDescription:Teachers:private] => Math teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 0
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 5
                        )

                    [1] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 6
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 2
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 102
                                            [subjectCode:Subjects:private] => PolSci101
                                            [subjectName:Subjects:private] => PolSci
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Political Science

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 302
                                            [teacherName:Teachers:private] => Paul
                                            [teacherDescription:Teachers:private] => PolSci teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 2
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 5
                        )

                )

            [6] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 1
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 0
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 101
                                            [subjectCode:Subjects:private] => MATH101
                                            [subjectName:Subjects:private] => Basic Math
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Basic Math

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 301
                                            [teacherName:Teachers:private] => John
                                            [teacherDescription:Teachers:private] => Math teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 0
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 6
                        )

                    [1] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 7
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 2
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 102
                                            [subjectCode:Subjects:private] => PolSci101
                                            [subjectName:Subjects:private] => PolSci
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Political Science

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 302
                                            [teacherName:Teachers:private] => Paul
                                            [teacherDescription:Teachers:private] => PolSci teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 2
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 6
                        )

                    [2] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 10
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 3
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 3
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 2
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                            [1] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 6
                        )

                )

            [7] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 11
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 3
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 3
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 2
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                            [1] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 7
                        )

                )

            [8] => 
            [9] => 
            [10] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 2
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 1
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 1
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 4
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 10
                        )

                    [1] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 14
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 5
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 102
                                            [subjectCode:Subjects:private] => PolSci101
                                            [subjectName:Subjects:private] => PolSci
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Political Science

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 302
                                            [teacherName:Teachers:private] => Paul
                                            [teacherDescription:Teachers:private] => PolSci teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 5
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 10
                        )

                )

            [11] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 3
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 1
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 1
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 4
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 11
                        )

                    [1] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 15
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 5
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 102
                                            [subjectCode:Subjects:private] => PolSci101
                                            [subjectName:Subjects:private] => PolSci
                                            [subjectRequiredPeriod:Subjects:private] => 2
                                            [subjectDescription:Subjects:private] => Political Science

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 202
                                            [traineeGroupName:TraineeGroups:private] => Mechtronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 302
                                            [teacherName:Teachers:private] => Paul
                                            [teacherDescription:Teachers:private] => PolSci teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 5
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 2

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 2
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 11
                        )

                )

            [12] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 4
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 1
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 1
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 4
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 12
                        )

                )

            [13] => Array
                (
                    [0] => Schedules Object
                        (
                            [scheduleID:Schedules:private] => 5
                            [scheduleTimetableID:Schedules:private] => Timetables Object
                                (
                                    [timetableID:Timetables:private] => 1
                                    [timetableAcademicYear:Timetables:private] => 2016
                                    [timetableTerm:Timetables:private] => 1
                                    [timetableDescription:Timetables:private] => test table
                                    [timetableFitness:Timetables:private] => 0
                                )

                            [scheduleSubjectClassID:Schedules:private] => SubjectClasses Object
                                (
                                    [subjectClassID:SubjectClasses:private] => 1
                                    [subjectClassSubjectID:SubjectClasses:private] => Subjects Object
                                        (
                                            [subjectID:Subjects:private] => 103
                                            [subjectCode:Subjects:private] => ENGL101
                                            [subjectName:Subjects:private] => Basic English
                                            [subjectRequiredPeriod:Subjects:private] => 4
                                            [subjectDescription:Subjects:private] => Basic English

                                        )

                                    [subjectClassTraineeGroupID:SubjectClasses:private] => TraineeGroups Object
                                        (
                                            [traineeGroupID:TraineeGroups:private] => 201
                                            [traineeGroupName:TraineeGroups:private] => Electronics
                                            [traineeGroupRemarks:TraineeGroups:private] => Group A
                                            [traineeGroupLevel:TraineeGroups:private] => 1

                                        )

                                    [subjectClassTeacherID:SubjectClasses:private] => Teachers Object
                                        (
                                            [teacherID:Teachers:private] => 303
                                            [teacherName:Teachers:private] => James
                                            [teacherDescription:Teachers:private] => English teacher

                                        )

                                    [subjectClassRoomID:SubjectClasses:private] => 
                                    [subjectClassPreferenceID:SubjectClasses:private] => Preferences Object
                                        (
                                            [preferencesID:Preferences:private] => 1
                                            [preferenceRoomType:Preferences:private] => Classroom
                                            [preferencePreferredStartPeriod:Preferences:private] => 1
                                            [preferencePreferredEndPeriod:Preferences:private] => 5
                                            [preferencePreferredNumberDays:Preferences:private] => 1
                                            [preferencePreferredNumberPeriodsDay:Preferences:private] => 4

                                        )

                                    [subjectClassDistributionBlock:SubjectClasses:private] => Array
                                        (
                                            [0] => 4
                                        )

                                    [isPossibleToDistribute:SubjectClasses:private] => 1
                                )

                            [scheduleSlot:Schedules:private] => 13
                        )

                )

            [14] => 
        )

)


*/
