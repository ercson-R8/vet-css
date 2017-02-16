<?php 
======================== <<0>> =======================================
    Subject:	Basic Math
    Req. Period:	2
    Group:		Electronics
    Teacher:	John
    Pref. Rm type:	Classroom
    Pref. duration:	1 day/s
    Room selected:  Room 1
    Dist block:	
    [day] => [no. of per]
    Array
    (
        [0] => 2
    )


    day: 0 no. of period/s: 2
    testing start period: 10
    ===Day number => +1====: 
    Array
    (
        [0] => 2
    )
    ==========
    10 * free
    11 * free

======================== <<1>> =======================================
    Subject:	Basic English
    Req. Period:	4
    Group:		Electronics
    Teacher:	James
    Pref. Rm type:	Classroom
    Pref. duration:	1 day/s
    Room selected:  Room 2
    Dist block:	
    [day] => [no. of per]
    Array
    (
        [0] => 4
    )


    day: 0 no. of period/s: 4
    testing start period: 5
    ===Day number => +1====: 
    Array
    (
        [0] => 1
    )
    ==========
    5 * free
    6 * free
    7 * free
    8 * free

======================== <<2>> =======================================
    Subject:	PolSci
    Req. Period:	2
    Group:		Electronics
    Teacher:	Paul
    Pref. Rm type:	Classroom
    Pref. duration:	1 day/s
    Room selected:  Room 2
    Dist block:	
    [day] => [no. of per]
    Array
    (
        [0] => 2
    )


    day: 0 no. of period/s: 2
    testing start period: 11
    ===Day number => +1====: 
    Array
    (
        [0] => 2
    )
    ==========
    11 * not free
    12 * free

======================== <<3>> =======================================
    Subject:	Basic English
    Req. Period:	4
    Group:		Mechtronics
    Teacher:	James
    Pref. Rm type:	Classroom
    Pref. duration:	2 day/s
    Room selected:  Room 1
    Dist block:	
    [day] => [no. of per]
    Array
    (
        [0] => 2
        [1] => 2
    )


    day: 0 no. of period/s: 2
    testing start period: 10

    day: 1 no. of period/s: 2
    testing start period: 0
    ===Day number => +1====: 
    Array
    (
        [0] => 2
        [1] => 0
    )
    ==========
    10 * not free
    11 * not free
    0 * free
    1 * free

======================== <<4>> =======================================
    Subject:	Basic Math
    Req. Period:	2
    Group:		Mechtronics
    Teacher:	John
    Pref. Rm type:	Classroom
    Pref. duration:	1 day/s
    Room selected:  Room 2
    Dist block:	
    [day] => [no. of per]
    Array
    (
        [0] => 2
    )


    day: 0 no. of period/s: 2
    testing start period: 10
    ===Day number => +1====: 
    Array
    (
        [0] => 2
    )
    ==========
    10 * not free
    11 * not free

======================== <<5>> =======================================
    Subject:	PolSci
    Req. Period:	2
    Group:		Mechtronics
    Teacher:	Paul
    Pref. Rm type:	Classroom
    Pref. duration:	1 day/s
    Room selected:  Room 2
    Dist block:	
    [day] => [no. of per]
    Array
    (
        [0] => 2
    )


    day: 0 no. of period/s: 2
    testing start period: 3
    ===Day number => +1====: 
    Array
    (
        [0] => 0
    )
    ==========
    3 * free
    4 * free

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
            [0] => 5
        )

    [4] => Array
        (
            [0] => 5
        )

    [5] => Array
        (
            [0] => 1
        )

    [6] => Array
        (
            [0] => 1
        )

    [7] => Array
        (
            [0] => 1
        )

    [8] => Array
        (
            [0] => 1
        )

    [9] => 
    [10] => Array
        (
            [0] => 0
            [1] => 3
            [2] => 4
        )

    [11] => Array
        (
            [0] => 0
            [1] => 2
            [2] => 3
            [3] => 4
        )

    [12] => Array
        (
            [0] => 2
        )

    [13] => 
    [14] => 
)
Array
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

            [scheduleSlot:Schedules:private] => 10
        )

    [1] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 11
        )

    [2] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 5
        )

    [3] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 6
        )

    [4] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 7
        )

    [5] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 8
        )

    [6] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 11
        )

    [7] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 12
        )

    [8] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 10
        )

    [9] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 11
        )

    [10] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 0
        )

    [11] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 1
        )

    [12] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 10
        )

    [13] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 11
        )

    [14] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 3
        )

    [15] => Schedules Object
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

            [scheduleSlot:Schedules:private] => 4
        )




// Genetic Algorithm
// Guess The Number
// Kevin Gisi
// http://youtube.com/gisikw

set TARGET_NUMBER to 42.

function genetic_algorithm {
  local population is starting_population().
  local generation is 1.

  until ending_conditions_met(population, generation) {
    for candidate in population {
      set_fitness_score(candidate).
    }

    clearscreen.
    print "=== Generation " + generation + " ===".
    print population:dump.
    wait 0.1.

    local parents is selection(population).
    local children is crossover(parents).
    mutate(children).

    set generation to generation + 1.
    set population to children.
  }

  clearscreen.
  print "=== Final Generation ===".
  print "(it took " + generation + " generations)".
  print population:dump.
}

function starting_population {
  local population is list().
  from{local i is 0.} until i=6 step{set i to i+1.} do {
    local candidate is lexicon().
    set candidate["fitness"] to -1.
    set candidate["chromosome"] to round(random() * 100).
    population:add(candidate).
  }
  return population.
}

function ending_conditions_met {
  parameter population, generation.
  for candidate in population {
    if candidate["chromosome"] = 42 return true.
  }
  return false.
}

function set_fitness_score {
  parameter candidate.
  local diff is abs(TARGET_NUMBER - candidate["chromosome"]).
  set candidate["fitness"] to 1 / max(diff, 0.01).
}

function selection {
  parameter population.
  local parents is list().

  set total_fitness to 0.
  for candidate in population {
    set total_fitness to total_fitness + candidate["fitness"].
  }

  until parents:length = population:length {
    local candidate is population[floor(population:length * random())].
    if random() < candidate["fitness"] / total_fitness {
      parents:add(candidate).
    }
  }

  return parents.
}

function crossover {
  parameter parents.
  local children is list().
  from{local i is 0.} until i=parents:length step{set i to i+2.} do {
    local mom is parents[i].
    local dad is parents[i+1].

    from{local j is 0.} until j=2 step{set j to j+1.} do {
      local child is lexicon().
      set child["fitness"] to -1.
      if random() < 0.5 {
        set child["chromosome"] to round((mom["chromosome"] + dad["chromosome"])/2).
      } else {
        if random() < 0.5 {
          set child["chromosome"] to mom["chromosome"].
        } else {
          set child["chromosome"] to dad["chromosome"].
        }
      }
      children:add(child).
    }

  }
  return children.
}

function mutate {
  parameter children.
  for candidate in children {
    if random() < 0.2 {
      if random() < 0.5 {
        set candidate["chromosome"] to candidate["chromosome"] + round(random() * 3).
      } else {
        set candidate["chromosome"] to candidate["chromosome"] - round(random() * 3).
      }
    }
  }
}

clearscreen.
genetic_algorithm().