import React from "react";

export default ({ uptime }: { uptime: number }) => {
  const วัน = Math.floor(uptime / (24 * 60 * 60));
  const ชั่วโมง = Math.floor((Math.floor(uptime) / 60 / 60) % 24);
  const ส่วนที่เหลือ = Math.floor(uptime - ชั่วโมง * 60 * 60);
  const นาที = Math.floor((ส่วนที่เหลือ / 60) % 60);
  const วินาที = ส่วนที่เหลือ % 60;

  if (วัน > 0) {
    return (
      <>
        {วัน}วัน {ชั่วโมง}ชั่วโมง {นาที}นาที
      </>
    );
  }

  return (
    <>
      {ชั่วโมง}ชั่วโมง {นาที}นาที {วินาที}วินาที
    </>
  );
};
