import React from "react";
import { Schedule } from "@/api/server/schedules/getServerSchedules";
import classNames from "classnames";

interface Props {
  cron: Schedule["cron"];
  className?: string;
}

const ScheduleCronRow = ({ cron, className }: Props) => (
  <div className={classNames("flex", className)}>
    <div className={"w-1/5 sm:w-auto text-center"}>
      <p className={"font-medium"}>{cron.minute}</p>
      <p className={"text-2xs text-neutral-500 uppercase"}>นาที</p>
    </div>
    <div className={"w-1/5 sm:w-auto text-center ml-4"}>
      <p className={"font-medium"}>{cron.hour}</p>
      <p className={"text-2xs text-neutral-500 uppercase"}>วินาที</p>
    </div>
    <div className={"w-1/5 sm:w-auto text-center ml-4"}>
      <p className={"font-medium"}>{cron.dayOfMonth}</p>
      <p className={"text-2xs text-neutral-500 uppercase"}>วัน (เดือน)</p>
    </div>
    <div className={"w-1/5 sm:w-auto text-center ml-4"}>
      <p className={"font-medium"}>{cron.month}</p>
      <p className={"text-2xs text-neutral-500 uppercase"}>เดือน</p>
    </div>
    <div className={"w-1/5 sm:w-auto text-center ml-4"}>
      <p className={"font-medium"}>{cron.dayOfWeek}</p>
      <p className={"text-2xs text-neutral-500 uppercase"}>วัน (สัปดาห์)</p>
    </div>
  </div>
);

export default ScheduleCronRow;
